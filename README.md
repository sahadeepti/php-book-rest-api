# Basic Php Rest Api
>Basic Rest Api to create, read, update, and delete books.

## Project Setup

Import the book.sql file in database, it contains the structure of the book table.

Place the folder book in htdocs(XAMPP) or www(WAMP).

## Endpoints

### Get All Books within a limit, pass the value of limit in query string.

``` bash
http://localhost/book/index.php/list?limit=10
```

### Search Books by book title, author, or genre. Make a GET request and pass the search keyword in query string.

``` bash
http://localhost/book/index.php/search?search=fiction
```

### Create Book record. Make a POST request and pass data in json format

``` bash
http://localhost/book/index.php/create

# Request sample
# {
#   "book_title":"Nineteen Eighty-Four",
#   "author": "George Orwell",
#   "genre" : "Fictional",
#   "price" : "1100.76"
# }
```

### Update Book record. Make a PUT request and pass data in json format

``` bash
http://localhost/book/index.php/update

# Request sample
# {
#   "id" : 3,
#   "book_title":"Nineteen Eighty-Four",
#   "author": "George Orwell",
#   "genre" : "Fictional",
#   "price" : "1100.76"
# }
```

### Update RATING of a Book record. Make a PATCH request and pass data in json format

``` bash
http://localhost/book/index.php/rating

# Request sample
# {
#   "id" : 3,
#   "rating" : "4.8"
# }
```

### Delete Book record. Make a DELETE request and pass the book id in query string.

``` bash
http://localhost/book/index.php/delete?id=1
```
