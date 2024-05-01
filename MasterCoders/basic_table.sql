create table colors (
	id INT PRIMARY KEY AUTO_INCREMENT,
	Name VARCHAR(15) UNIQUE NOT NULL,
	hex_value VARCHAR(7) UNIQUE NOT NULL
);

Insert into colors (id, Name, hex_value)
VALUES
	(1, 'red', '#FF0000'),
	(2, 'orange', '#FFA500'),
	(3, 'yellow', '#FFFF00'),
	(4, 'green', '#008000'),
	(5, 'blue', '#0000FF'),
	(6, 'purple', '#800080'),
	(7, 'grey', '#808080'),
	(8, 'brown', '#A52A2A'),
	(9, 'black', '#000000'),
	(10, 'teal', '#008080');