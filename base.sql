DROP DATABASE IF EXISTS sa;

CREATE DATABASE IF NOT EXISTS sa;
USE sa;
# -----------------------------------------------------------------------------
#       TABLE : PROF
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROF
 (
   ID_PRO INT NOT NULL AUTO_INCREMENT ,
   ID_MAT INT NOT NULL  ,
   NOM_PRO CHAR(32) NULL  ,
   NUM_TELE_PRO CHAR(32) NULL  ,
   MAIL_PRO CHAR(32) NULL  ,
   PART_PRO REAL(5,2) NULL  
   , PRIMARY KEY (ID_PRO) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PROF
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PROF_MATIERE
     ON PROF (ID_MAT ASC);

# -----------------------------------------------------------------------------
#       TABLE : MATIERE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS MATIERE
 (
   ID_MAT INT NOT NULL AUTO_INCREMENT ,
   NOM_MAT CHAR(32) NULL  
   , PRIMARY KEY (ID_MAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ELEVE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ELEVE
 (
   ID_EL INT NOT NULL AUTO_INCREMENT ,
   ID_NIVEAUX INT NOT NULL  ,
   ID_SEC INT NULL  ,
   ID_ANNEE INT NOT NULL  ,
   NOM__EL CHAR(32) NULL  ,
   NUM_TELE_EL CHAR(32) NULL  ,
   MAIL_EL CHAR(32) NULL  ,
   MDP_EL CHAR(32) NULL  ,
   REDUCTION_EL REAL(5,2) NULL  
   , PRIMARY KEY (ID_EL) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ELEVE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ELEVE_NIVEAUX
     ON ELEVE (ID_NIVEAUX ASC);

CREATE  INDEX I_FK_ELEVE_SECTION
     ON ELEVE (ID_SEC ASC);

CREATE  INDEX I_FK_ELEVE_ANNEE_SCOLAIRE
     ON ELEVE (ID_ANNEE ASC);

# -----------------------------------------------------------------------------
#       TABLE : DUREE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS DUREE
 (
   ID_DUREE INT NOT NULL AUTO_INCREMENT ,
   DUREE VARCHAR(128) NULL  
   , PRIMARY KEY (ID_DUREE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : SECTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SECTION
 (
   ID_SEC INT NOT NULL AUTO_INCREMENT ,
   NOM_SEC CHAR(32) NULL  
   , PRIMARY KEY (ID_SEC) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : OFFRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS OFFRE
 (
   ID_OFFRE INT NOT NULL AUTO_INCREMENT ,
   ID_DUREE INT NOT NULL  ,
   NOM_OFFRE CHAR(32) NULL  ,
   DATE_DEBUT_OFFRE CHAR(32) NULL  ,
   DATE_FIN_OFFRE CHAR(32) NULL  ,
   PRIX_OFFRE CHAR(32) NULL  
   , PRIMARY KEY (ID_OFFRE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE OFFRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_OFFRE_DUREE
     ON OFFRE (ID_DUREE ASC);

# -----------------------------------------------------------------------------
#       TABLE : NIVEAUX
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS NIVEAUX
 (
   ID_NIVEAUX INT NOT NULL AUTO_INCREMENT ,
   NIVEAUX CHAR(32) NULL  
   , PRIMARY KEY (ID_NIVEAUX) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : ANNEE_SCOLAIRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ANNEE_SCOLAIRE
 (
   ID_ANNEE INT NOT NULL AUTO_INCREMENT ,
   ANNEE CHAR(32) NULL  
   , PRIMARY KEY (ID_ANNEE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : APPARTIENIR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS APPARTIENIR
 (
   ID_OFFRE INT NOT NULL AUTO_INCREMENT ,
   ID_MAT INT NOT NULL  
   , PRIMARY KEY (ID_OFFRE,ID_MAT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE APPARTIENIR
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_APPARTIENIR_OFFRE
     ON APPARTIENIR (ID_OFFRE ASC);

CREATE  INDEX I_FK_APPARTIENIR_MATIERE
     ON APPARTIENIR (ID_MAT ASC);

# -----------------------------------------------------------------------------
#       TABLE : ACHETER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ACHETER
 (
   ID_EL INT NOT NULL AUTO_INCREMENT ,
   ID_OFFRE INT NOT NULL  
   , PRIMARY KEY (ID_EL,ID_OFFRE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ACHETER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ACHETER_ELEVE
     ON ACHETER (ID_EL ASC);

CREATE  INDEX I_FK_ACHETER_OFFRE
     ON ACHETER (ID_OFFRE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE PROF 
  ADD FOREIGN KEY FK_PROF_MATIERE (ID_MAT)
      REFERENCES MATIERE (ID_MAT) ;


ALTER TABLE ELEVE 
  ADD FOREIGN KEY FK_ELEVE_NIVEAUX (ID_NIVEAUX)
      REFERENCES NIVEAUX (ID_NIVEAUX) ;


ALTER TABLE ELEVE 
  ADD FOREIGN KEY FK_ELEVE_SECTION (ID_SEC)
      REFERENCES SECTION (ID_SEC) ;


ALTER TABLE ELEVE 
  ADD FOREIGN KEY FK_ELEVE_ANNEE_SCOLAIRE (ID_ANNEE)
      REFERENCES ANNEE_SCOLAIRE (ID_ANNEE) ;


ALTER TABLE OFFRE 
  ADD FOREIGN KEY FK_OFFRE_DUREE (ID_DUREE)
      REFERENCES DUREE (ID_DUREE) ;


ALTER TABLE APPARTIENIR 
  ADD FOREIGN KEY FK_APPARTIENIR_OFFRE (ID_OFFRE)
      REFERENCES OFFRE (ID_OFFRE) ;


ALTER TABLE APPARTIENIR 
  ADD FOREIGN KEY FK_APPARTIENIR_MATIERE (ID_MAT)
      REFERENCES MATIERE (ID_MAT) ;


ALTER TABLE ACHETER 
  ADD FOREIGN KEY FK_ACHETER_ELEVE (ID_EL)
      REFERENCES ELEVE (ID_EL) ;


ALTER TABLE ACHETER 
  ADD FOREIGN KEY FK_ACHETER_OFFRE (ID_OFFRE)
      REFERENCES OFFRE (ID_OFFRE) ;

