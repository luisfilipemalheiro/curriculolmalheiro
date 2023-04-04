create table SIR.aboutme
(
    id          int          not null
        primary key,
    firstname   varchar(50)  null,
    lastname    varchar(50)  null,
    description varchar(200) null,
    imagepath   varchar(300) null
);


create table SIR.contactme
(
    id        int auto_increment
        primary key,
    idaboutme int          not null,
    name      varchar(80)  null,
    email     varchar(100) null,
    message   varchar(200) null,
    constraint contactme_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on SIR.contactme (idaboutme);

create table SIR.contacts
(
    id        int auto_increment
        primary key,
    idaboutme int          not null,
    telephone decimal(9)   null,
    email     varchar(100) null,
    constraint contacts_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on SIR.contacts (idaboutme);

create table SIR.experience
(
    id         int         not null
        primary key,
    idaboutme  int         not null,
    title      varchar(50) null,
    descripton varchar(50) null,
    constraint experience_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on SIR.experience (idaboutme);

create table SIR.hardskills
(
    id        int auto_increment
        primary key,
    idaboutme int         not null,
    descricao varchar(50) null,
    constraint hardskills_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on SIR.hardskills (idaboutme);

create table SIR.rolesuser
(
    id          int         not null
        primary key,
    description varchar(50) null
);

create table SIR.scholl
(
    id        int auto_increment
        primary key,
    idaboutme int         not null,
    descricao varchar(70) null,
    startyear varchar(10) null,
    endyear   varchar(10) null,
    constraint scholl_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on SIR.scholl (idaboutme);

create table SIR.softskills
(
    id        int auto_increment
        primary key,
    idaboutme int         not null,
    descricao varchar(50) null,
    constraint softskills_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on SIR.softskills (idaboutme);

create table SIR.tasks
(
    id          int auto_increment
        primary key,
    descripton  varchar(70) null,
    idexpirence int         not null,
    constraint tasks_ibfk_1
        foreign key (idexpirence) references experience (id)
);

create index idexpirence
    on SIR.tasks (idexpirence);

create table SIR.users
(
    id        int auto_increment
        primary key,
    typeuser  int          not null,
    idaboutme int          not null,
    username  varchar(100) null,
    password  varchar(100) null,
    name      varchar(50)  null,
    constraint users_ibfk_1
        foreign key (idaboutme) references aboutme (id),
    constraint users_ibfk_2
        foreign key (typeuser) references rolesuser (id)
);

create index idaboutme
    on SIR.users (idaboutme);

create index typeuser
    on SIR.users (typeuser);
