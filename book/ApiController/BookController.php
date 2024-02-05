<?php
class BookController extends BaseController
{
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if(strtoupper($requestMethod) == 'GET')
        {
            try{
                $bookModel = new BookModel();
                $intLimit = 10;
                if(isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit'])
                {
                    $intLimit = $arrQueryStringParams['limit'];
                }
                $arrBooks = $bookModel->getBooks($intLimit);
                $responseData = json_encode($arrBooks);
            } catch(Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong ! Please contact support';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
          
        }
        if(!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader));
        }
    }

    public function createAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if(strtoupper($requestMethod) == 'POST')
        {
            try{
                $bookModel = new BookModel();
                $arrQueryStringParams = json_decode(file_get_contents('php://input'), true) ;
                $bookId = $bookModel->createBook($arrQueryStringParams);
                $newBook = $bookModel->returnBook($bookId);
                $responseData = json_encode($newBook);
            } catch(Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong ! Please contact support';
                $strErrorHeader = 'HTTP/1.1 500 Inter Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
           
        }
        if(!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader));
        }
    }

    public function updateAction()
    {
        $strErrorDesc = '';
        $requestMethod= $_SERVER["REQUEST_METHOD"];
        if(strtoupper($requestMethod) == 'PUT')
        {
            try {
                $bookModel = new bookModel();
                $arrQueryStringParams = json_decode(file_get_contents('php://input'), true);
                $bookId = $arrQueryStringParams['id'];
                $bookModel->updateBook($arrQueryStringParams);
                $updatedBook = $bookModel->returnBook($bookId);
                $responseData = json_encode($updatedBook);
            } catch(Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong ! Please contact support';
                $strErrorHeader = 'HTTP/1.1 500 Inter Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
           
        }
        if(!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader));
        }
    }

    public function searchAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if(strtoupper($requestMethod) == 'GET')
        {
            try{
                $bookModel = new BookModel();
                $search='';
                $arrBooks=[];
                if(isset($arrQueryStringParams['search']) && $arrQueryStringParams['search'])
                {
                    $search = $arrQueryStringParams['search'];
                }
                $arrBooks = $bookModel->searchBook($search);
                $responseData = json_encode($arrBooks);
            } catch(Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong ! Please contact support';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
          
        }
        if(!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader));
        }
    }

    public function deleteAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if(strtoupper($requestMethod) == 'DELETE')
        {
            try{
                $bookModel = new BookModel();
                $deleteId = 0;
                if(isset($arrQueryStringParams['id']) && $arrQueryStringParams['id'])
                {
                    $deleteId = $arrQueryStringParams['id'];
                }
                $bookModel->deleteBook($deleteId);
                $responseData = json_encode(['message' => 'Data Deleted']);
            } catch(Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong ! Please contact support';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
          
        }
        if(!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader));
        }
    }
    
    public function ratingAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        if(strtoupper($requestMethod) == 'PATCH')
        {
            try{
                $bookModel = new BookModel();
                $arrQueryStringParams = json_decode(file_get_contents('php://input'), true);
                $bookId = $arrQueryStringParams['id'];
                $bookModel->updateRating($arrQueryStringParams);
                $updatedBook = $bookModel->returnBook($bookId);
                $responseData = json_encode($updatedBook);
            } catch(Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong ! Please contact support';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
          
        }
        if(!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
            array('Content-Type: application/json', $strErrorHeader));
        }
    }
}