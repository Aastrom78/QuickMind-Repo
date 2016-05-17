#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        pseudo         Varchar (25) NOT NULL ,
        name           Varchar (25) ,
        surname        Varchar (25) ,
        email          Varchar (25) ,
        password       Varchar (25) ,
        social_network Varchar (25) ,
        is_valid       Bool ,
        is_admin       Bool ,
        accesstoken    Varchar (25) ,
        score          Numeric ,
        id_rank        Int ,
        PRIMARY KEY (pseudo ) ,
        UNIQUE (email )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: GAME
#------------------------------------------------------------

CREATE TABLE GAME(
        id_game       Int NOT NULL AUTO_INCREMENT ,
        score         Int ,
        game_date     Date ,
        difficulty    Int ,
        pseudo        Varchar (25) ,
        name_category Varchar (7) ,
        PRIMARY KEY (id_game )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CATEGORY
#------------------------------------------------------------

CREATE TABLE CATEGORY(
        name_category Varchar (7) NOT NULL ,
        PRIMARY KEY (name_category )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: MEDIAS
#------------------------------------------------------------

CREATE TABLE MEDIAS(
        id_medias     Int NOT NULL AUTO_INCREMENT ,
        title         Varchar (25) ,
        name_category Varchar (7) ,
        PRIMARY KEY (id_medias )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: TAGS
#------------------------------------------------------------

CREATE TABLE TAGS(
        id_tag    Int NOT NULL AUTO_INCREMENT ,
        name      Varchar (25) ,
        attribute Varchar (25) ,
        PRIMARY KEY (id_tag )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: RANK
#------------------------------------------------------------

CREATE TABLE RANK(
        id_rank Int NOT NULL AUTO_INCREMENT ,
        name    Varchar (25) ,
        logo    Varchar (25) ,
        PRIMARY KEY (id_rank )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: DEFINED
#------------------------------------------------------------

CREATE TABLE DEFINED(
        title_tag Varchar (25) ,
        id_medias Int NOT NULL ,
        id_tag    Int NOT NULL ,
        PRIMARY KEY (id_medias ,id_tag )
)ENGINE=InnoDB;

ALTER TABLE USERS ADD CONSTRAINT FK_Users_id_rank FOREIGN KEY (id_rank) REFERENCES RANK(id_rank);
ALTER TABLE GAME ADD CONSTRAINT FK_GAME_pseudo FOREIGN KEY (pseudo) REFERENCES Users(pseudo);
ALTER TABLE GAME ADD CONSTRAINT FK_GAME_name_category FOREIGN KEY (name_category) REFERENCES CATEGORY(name_category);
ALTER TABLE MEDIAS ADD CONSTRAINT FK_MEDIAS_name_category FOREIGN KEY (name_category) REFERENCES CATEGORY(name_category);
ALTER TABLE DEFINED ADD CONSTRAINT FK_DEFINED_id_medias FOREIGN KEY (id_medias) REFERENCES MEDIAS(id_medias);
ALTER TABLE DEFINED ADD CONSTRAINT FK_DEFINED_id_tag FOREIGN KEY (id_tag) REFERENCES TAGS(id_tag);
