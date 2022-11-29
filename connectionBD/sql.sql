create table aboutme
(
    id          int          not null
        primary key,
    firstname   varchar(50)  null,
    lastname    varchar(50)  null,
    description varchar(200) null,
    imagepath   varchar(300) null
);

create table contactme
(
    id        int          not null
        primary key,
    idaboutme int          not null,
    name      varchar(80)  null,
    email     varchar(100) null,
    message   varchar(200) null,
    constraint contactme_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on contactme (idaboutme);

create table contacts
(
    id        int          not null
        primary key,
    idaboutme int          not null,
    telephone decimal(9)   null,
    email     varchar(100) null,
    constraint contacts_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on contacts (idaboutme);

create table experience
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
    on experience (idaboutme);

create table hardskills
(
    id        int         not null
        primary key,
    idaboutme int         not null,
    descricao varchar(50) null,
    constraint hardskills_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on hardskills (idaboutme);

create table rolesuser
(
    id          int         not null
        primary key,
    description varchar(50) null
);

create table scholl
(
    id        int         not null
        primary key,
    idaboutme int         not null,
    descricao varchar(70) null,
    startyear varchar(10) null,
    endyear   varchar(10) null,
    constraint scholl_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on scholl (idaboutme);

create table softskills
(
    id        int         not null
        primary key,
    idaboutme int         not null,
    descricao varchar(50) null,
    constraint softskills_ibfk_1
        foreign key (idaboutme) references aboutme (id)
);

create index idaboutme
    on softskills (idaboutme);

create table tasks
(
    id          int         not null
        primary key,
    descripton  varchar(70) null,
    idexpirence int         not null,
    constraint tasks_ibfk_1
        foreign key (idexpirence) references experience (id)
);

create index idexpirence
    on tasks (idexpirence);

create table users
(
    id        int          not null
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
    on users (idaboutme);

create index typeuser
    on users (typeuser);

