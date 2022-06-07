
create table tblTelefone_Estacionamento (
	id int unsigned not null primary key auto_increment,
    telefone varchar(20) not null,
    idEstacionamento int unsigned not null,
    
    constraint FK_Telefone_Estacionamento
	foreign key(idEstacionamento)
    references tblEstacionamento(id),
    
    unique index(id)
);

insert into tblTelefone_Estacionamento
			(telefone,
            idEstacionamento)
			values(
            "11 99999-9999",
            1
            );

update tblTelefone_Estacionamento set telefone = "" where id = 1;

delete from tblTelefone_Estacionamento where id = 1;

select * from tblTelefone_Estacionamento;