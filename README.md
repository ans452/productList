It is a small web application designed to manage the list of products. Its functionality includes:
viewing products by categories
deleting products/categories
editing products/categories
To deploy this application, it is needed to set it up on the server. The working version is available by the link:
https://enos.itcollege.ee/~anarus/admission/index.php

Mentioned above functionality is reached via the classes communicating with JSON files directly and controllers that are mediators between JSON encoding issues and user's needs.
Also, folder "utils" can be found in the repository where additional functionality is implemented like validating input, downloading pictures of page pagination. Controllers are designed to process the HTTP requests and fulfil the user's needs -- view, insert, edit, delete. 
At the highest level of abstraction the developer just needs to initialize the object and use one of its public methods:


```
---example-------------------------------------
$viewer = new ViewingController();
$products = $viewer->get_product_list();
----------------------------------------------```

