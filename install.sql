ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';



CREATE DATABASE IF NOT EXISTS form;



CREATE TABLE form.`users` (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

	name VARCHAR(255),

	pass VARCHAR(255)

);



INSERT INTO form.`users` (`name`, `pass`) VALUES ('jeff', '2e0b8d61fa2a6959d254b6ff5d0fb512249329097336a35568089933b49abdde');

INSERT INTO form.`users` (`name`, `pass`) VALUES ('jhon', 'b05c795b89f37b931a14d46065daa20e7111af18560e03002235257367952406');

INSERT INTO form.`users` (`name`, `pass`) VALUES ('user', '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb');
