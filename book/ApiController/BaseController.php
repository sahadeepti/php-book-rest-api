<?php
class BaseController
{
    public function _call($name, $argument)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $uri = explode('/',$uri);
        return $uri;
    }

    protected function getQueryStringParams()
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }

    protected function sendOutput($data,$httpheaders = array())
    {
        header_remove('Set Cookie');
        if(is_array($httpheaders) && count($httpheaders))
        {
            foreach($httpheaders as $httpheader)
            {
                header($httpheader);
            }
        }
        echo $data;
        exit;
    }
}