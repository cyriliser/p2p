
create table adminUserComplaints(
	id int not null auto_increment,
	from_user int,
	msg varchar(5000),
	opened bit,
	date_received date,
	
	primary key(id),
	foreign key(from_user) references users(id)
);
create table adminRefsComplaints(
	id int not null auto_increment,
	from_user int,
	msg varchar(5000),
	opened bit,
	date_received date,
	
	primary key(id),
	foreign key(from_user) references refs(id)
);