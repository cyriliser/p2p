create table users (
	id int NOT NULL AUTO_INCREMENT,
	username varchar(50),
	email varchar(50),
	password varchar(50),
	name varchar(50),
	surname varchar(50),
	date_of_birth date,
	contact_cell int,
	bank_name varchar(50),
	account_no int,
	linked_cell int,
	
	PRIMARY KEY(id)
);
create table refs (
	id int NOT NULL AUTO_INCREMENT,
	username varchar(50),
	email varchar(50),
	password varchar(50),
	name varchar(50),
	surname varchar(50),
	date_of_birth date,
	contact_cell int,
	bank_name varchar(50),
	account_no int,
	linked_cell int,
	referer_id int NOT NULL,
	
	PRIMARY KEY(id),
	FOREIGN KEY (referer_id) REFERENCES users(id)
);
create table inbox(
	id int not null auto_increment,
	owner int,
	ref_sender int,
	user_sender int,
	msg varchar(5000),
	opened bit,
	date_received date,
	
	primary key(id),
	foreign key (owner) references users(id),
	foreign key (user_sender) references users(id),
	foreign key (ref_sender) references refs(id)
);
create table adminUserComplaints(
	id int not null auto_increment,
	from_user int,
	msg varchar(5000),
	opened bit,
	date_received date
	
	primary key(id),
	foreign key(from_user) references users(id)
);
create table adminRefsComplaints(
	id int not null auto_increment,
	from_user int,
	msg varchar(5000),
	opened bit,
	date_received date
	
	primary key(id),
	foreign key(from_user) references refs(id)
);
