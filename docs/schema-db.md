# Структура БД

schema **WFORGE** (
* table **USER**  
    * **id** integer *pk*   
    * **nickname** varchar(30) *index*   
    * **password_hash** char(60)  
    * **registered** timestamp  

* table **USER_DETAIL**  
    * **user_id** integer *pk*   
    * **name** varchar(100)  
    * **email** varchar(50)  
    * **image** blob  
    * **image_mime** varchar(50)
    
)