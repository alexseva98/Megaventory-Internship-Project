# Megaventory-Intership-Project
In this project I used php and you will need xampp to run it,the file must be inside the htdocs folder inside the main xampps root folder 

the index.php file is our main page 

to run the script you must go to http://localhost/megaventory/index.php 

megaventory is my projects folder that contains the index.php and the folder Classes
that contains the external Classes:Product, SupplierClient and InventoryLocation

The following 5 objects are calling their respective create method to create new entries in the megaventory database 

and in return we get the id of each new entity in the database 


![image](https://github.com/alexseva98/Megaventory-Intership-Project/assets/62871935/8db9db31-f3a2-41fa-94b2-5167dbdc5bce) 


then we call the following functions to create relationships between products and client/supplier 
and to update the stock of the 2 products that we created at 5 units 
 
![image](https://github.com/alexseva98/Megaventory-Intership-Project/assets/62871935/fba6f149-e950-4fc0-802f-8fb84086a5d5) 

When we run the script and navigate to http://localhost/megaventory/index.php ,if the entries arent allready present in the database we get this result:
(due to numerous testing I had to put 0 before every value to make it looks as close to the original values as possible) 


![image](https://github.com/alexseva98/Megaventory-Intership-Project/assets/62871935/73db6fa1-9074-4a09-8274-470469528925) 

now if we reaload the page this is the result we will get cause we trying to add the same values in the database 

![image](https://github.com/alexseva98/Megaventory-Intership-Project/assets/62871935/0444e4b2-005e-47d2-924f-5e290ad2e722)




