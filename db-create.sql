CREATE DATABASE epiz_23658448_unique_chicken
;

use epiz_23658448_unique_chicken
;

CREATE TABLE unique_data (

    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    chickname varchar(30) NOT NULL,
    chickbreed VARCHAR(30) NOT NULL,
    chicksex VARCHAR(30) NOT NULL,
    chickhatch VARCHAR(30) NOT NULL,
    date TIMESTAMP    
);