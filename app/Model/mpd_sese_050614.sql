#------------------------------------------------------------
#        MPD Livret PFMP - application SESE - VERSION 050614
#	www.silibre.com
#------------------------------------------------------------


CREATE TABLE Competence(
        id_competence              int (11) Auto_increment  NOT NULL ,
        comp_ref_competence        Varchar (20) ,
        comp_intitule_competence   Varchar (20) ,
        comp_descriptif_competence TinyText ,
        comp_est_evaluable         Bool ,
        comp_est_evaluee           Bool ,
        comp_niveau_competence     Varchar (20) ,
        comp_niveau_autonomie      Varchar (20) ,
        PRIMARY KEY (id_competence )
)ENGINE=InnoDB;


CREATE TABLE Referentiel_de_formation(
        id_referentiel_de_formation int (11) Auto_increment  NOT NULL ,
        rdf_nom_formation           Varchar (20) ,
        rdf_domaine_formation       Varchar (20) ,
        rdf_reference               Varchar (20) ,
        rdf_intitule                Varchar (20) ,
        rdf_descriptif              Text ,
        rdf_duree_formation         Integer ,
        rdf_nombre_jours_stage      Integer ,
        PRIMARY KEY (id_referentiel_de_formation )
)ENGINE=InnoDB;


CREATE TABLE Activite(
        id_activite                 int (11) Auto_increment  NOT NULL ,
        act_ref_activite            Varchar (20) ,
        act_intitule_activite       Varchar (20) ,
        act_descriptif_activite     Text ,
        act_est_realisee            Bool ,
        id_referentiel_de_formation Int ,
        id_fonction                 Int ,
        PRIMARY KEY (id_activite )
)ENGINE=InnoDB;


CREATE TABLE Documents_reference(
        id_documents_reference      int (11) Auto_increment  NOT NULL ,
        drf_sujet                   Varchar (25) ,
        id_referentiel_de_formation Int ,
        PRIMARY KEY (id_documents_reference )
)ENGINE=InnoDB;


CREATE TABLE Fonction(
        id_fonction   int (11) Auto_increment  NOT NULL ,
        f_description Text ,
        PRIMARY KEY (id_fonction )
)ENGINE=InnoDB;


CREATE TABLE Etablissement(
        id_etablissement            int (11) Auto_increment  NOT NULL ,
        eta_nom_etablissement       Varchar (40) ,
        eta_siret_etablissement     Varchar (40) ,
        eta_adresse1_etabliseement  Varchar (64) ,
        eta_adresse2_etablissement  Varchar (64) ,
        eta_ville_etablissement     Varchar (20) ,
        eta_cp_etablissement        Integer ,
        eta_url_etablissement       Varchar (40) ,
        eta_mel_etablissement       Varchar (40) ,
        eta_telephone_etablissement Integer ,
        PRIMARY KEY (id_etablissement )
)ENGINE=InnoDB;


CREATE TABLE Promotion(
        id_promotion                int (11) Auto_increment  NOT NULL ,
        pro_nom_promotion           Varchar (20) ,
        pro_reference_promotion     Varchar (20) ,
        id_referentiel_de_formation Int ,
        PRIMARY KEY (id_promotion )
)ENGINE=InnoDB;


CREATE TABLE Stagiaire(
        id_stagiaire            int (11) Auto_increment  NOT NULL ,
        sta_civilite_stagiaire  Varchar (20) ,
        sta_nom_stagiaire       Varchar (40) ,
        sta_prenom_stagiaire    Varchar (40) ,
        sta_mel_stagiaire       Varchar (40) ,
        sta_adresse1_stagiaire  Varchar (40) ,
        sta_adresse2_stagiaire  Varchar (40) ,
        sta_url_stagiaire       Varchar (40) ,
        sta_cp_stagiaire        Integer ,
        sta_civilite_resp_legal Varchar (20) ,
        sta_nom_resp_legal      Varchar (40) ,
        sta_prenom_resp_legal   Varchar (40) ,
        sta_mel_resp_legal      Varchar (40) ,
        sta_adresse1_resp_legal Varchar (40) ,
        sta_adresse2_resp_legal Varchar (40) ,
        sta_url_resp_legal      Varchar (40) ,
        sta_cp_resp_legal       Integer ,
        sta_affiliation         Varchar (40) ,
        id_promotion            Int ,
        id_enseignant           Int ,
        PRIMARY KEY (id_stagiaire )
)ENGINE=InnoDB;


CREATE TABLE Enseignant(
        id_enseignant           int (11) Auto_increment  NOT NULL ,
        ens_civilite_enseignant Varchar (20) ,
        ens_nom_enseignant      Varchar (40) ,
        ens_prenom_enseignant   Varchar (40) ,
        ens_mel_enseignant      Varchar (40) ,
        ens_adresse1_enseignant Varchar (64) ,
        ens_adresse2_enseignant Varchar (64) ,
        ens_url_enseignant      Varchar (40) ,
        ens_cp_enseignant       Integer ,
        ens_discipline          Varchar (40) ,
        ens_role                Varchar (20) ,
        ens_est_referant        Bool ,
        ens_compte_enseignant   Varchar (40) ,
        PRIMARY KEY (id_enseignant )
)ENGINE=InnoDB;


CREATE TABLE Stage(
        id_stage                    int (11) Auto_increment  NOT NULL ,
        stg_denomination_periode    Varchar (20) ,
        stg_date_debut              Date ,
        stg_date_fin                Date ,
        stg_est_ouvrable            Bool ,
        stg_status_stage            Varchar (20) ,
        stg_annee_stage             Year ,
        commentaire_tuteur          Text ,
        id_collaborateurs           Int ,
        id_referentiel_de_formation Int ,
        id_enseignant               Int ,
        PRIMARY KEY (id_stage )
)ENGINE=InnoDB;


CREATE TABLE Entreprise(
        id_entreprise            int (11) Auto_increment  NOT NULL ,
        ent_nom_entreprise       Varchar (40) ,
        ent_nom_commercial       Varchar (40) ,
        ent_siret                Varchar (40) ,
        ent_activite             Varchar (40) ,
        ent_profil               Varchar (40) ,
        ent_stagiaires_recus     Text ,
        ent_commentaire          Text ,
        ent_date_enregistrement  Date ,
        ent_adresse1_entreprise  Varchar (40) ,
        ent_adresse2_entreprise  Varchar (40) ,
        ent_ville_entreprise     Varchar (40) ,
        ent_cp_entreprise        Integer ,
        ent_pays_entreprise      Varchar (40) ,
        ent_url_entreprise       Varchar (40) ,
        ent_telephone_entreprise Varchar (30) ,
        PRIMARY KEY (id_entreprise )
)ENGINE=InnoDB;


CREATE TABLE Collaborateurs(
        id_collaborateurs        int (11) Auto_increment  NOT NULL ,
        col_civilite             Varchar (20) ,
        col_nom                  Varchar (40) ,
        col_prenom               Varchar (40) ,
        col_mel                  Varchar (40) ,
        col_adresse1             Varchar (40) ,
        col_adresse2             Varchar (40) ,
        col_url                  Varchar (40) ,
        col_cp                   Integer ,
        col_role_entreprise      Varchar (40) ,
        col_compte_collaborateur Varchar (40) ,
        PRIMARY KEY (id_collaborateurs )
)ENGINE=InnoDB;


CREATE TABLE Description_document(
        id_description_document int (11) Auto_increment  NOT NULL ,
        ddo_description_doc     Text ,
        id_documents_reference  Int ,
        PRIMARY KEY (id_description_document )
)ENGINE=InnoDB;


CREATE TABLE Activite_et_visite(
        id_activite_et_visite    int (11) Auto_increment  NOT NULL ,
        aev_date_activite        Date ,
        aev_description_activite Text ,
        aev_type_acteur          Varchar (20) ,
        aev_id_type_acteur       Varchar (20) ,
        id_enseignant            Int ,
        id_stagiaire             Int ,
        PRIMARY KEY (id_activite_et_visite )
)ENGINE=InnoDB;


CREATE TABLE Utilisateurs(
        id_utilisateur         int (11) Auto_increment  NOT NULL ,
        uti_identifiant        Varchar (20) ,
        uti_mot_de_passe       Varchar (40) ,
        uti_mel                Varchar (40) ,
        uti_etat_compte        Varchar (20) ,
        uti_derniere_connexion Datetime ,
        id_groupe              Int ,
        PRIMARY KEY (id_utilisateur )
)ENGINE=InnoDB;


CREATE TABLE Annee(
        annee_scolaire Year NOT NULL ,
        PRIMARY KEY (annee_scolaire )
)ENGINE=InnoDB;


CREATE TABLE Reference(
        id_reference    int (11) Auto_increment  NOT NULL ,
        ref_type_ref    Varchar (20) ,
        ref_code_ref    Varchar (20) ,
        ref_libelle_ref Varchar (20) ,
        PRIMARY KEY (id_reference )
)ENGINE=InnoDB;


CREATE TABLE Groupe(
        id_groupe      int (11) Auto_increment  NOT NULL ,
        grp_nom_groupe Varchar (20) ,
        PRIMARY KEY (id_groupe )
)ENGINE=InnoDB;


CREATE TABLE Page(
        id_page      int (11) Auto_increment  NOT NULL ,
        pge_nom_page Varchar (40) ,
        PRIMARY KEY (id_page )
)ENGINE=InnoDB;


CREATE TABLE Competences_evaluees(
        id_competences_realisees          int (11) Auto_increment  NOT NULL ,
        coe_annee_evaluation              Year ,
        coe_ref_competence_evaluee        Varchar (20) ,
        coe_intitule_competence_evaluee   Varchar (20) ,
        coe_descriptif_competence_evaluee TinyText ,
        coe_niveau_competence             Integer ,
        coe_niveau_autonomie              Integer ,
        id_stagiaire                      Int ,
        PRIMARY KEY (id_competences_realisees )
)ENGINE=InnoDB;


CREATE TABLE Parametres(
        id_parametres         int (11) Auto_increment  NOT NULL ,
        par_code_parametre    Varchar (8) ,
        par_libelle_parametre Varchar (20) ,
        par_valeur_parametre  Varchar (40) ,
        PRIMARY KEY (id_parametres )
)ENGINE=InnoDB;


CREATE TABLE Constituer(
        id_activite   Int NOT NULL ,
        id_competence Int NOT NULL ,
        PRIMARY KEY (id_activite ,id_competence )
)ENGINE=InnoDB;


CREATE TABLE Intervenir(
        annee         Year ,
        id_promotion  Int NOT NULL ,
        id_enseignant Int NOT NULL ,
        PRIMARY KEY (id_promotion ,id_enseignant )
)ENGINE=InnoDB;


CREATE TABLE Realiser(
        id_stagiaire Int NOT NULL ,
        id_stage     Int NOT NULL ,
        PRIMARY KEY (id_stagiaire ,id_stage )
)ENGINE=InnoDB;


CREATE TABLE employer(
        id_entreprise     Int NOT NULL ,
        id_collaborateurs Int NOT NULL ,
        PRIMARY KEY (id_entreprise ,id_collaborateurs )
)ENGINE=InnoDB;


CREATE TABLE Autoriser(
        type_droit Varchar (20) ,
        id_groupe  Int NOT NULL ,
        id_page    Int NOT NULL ,
        PRIMARY KEY (id_groupe ,id_page )
)ENGINE=InnoDB;

ALTER TABLE Activite ADD CONSTRAINT FK_Activite_id_referentiel_de_formation FOREIGN KEY (id_referentiel_de_formation) REFERENCES Referentiel_de_formation(id_referentiel_de_formation);
ALTER TABLE Activite ADD CONSTRAINT FK_Activite_id_fonction FOREIGN KEY (id_fonction) REFERENCES Fonction(id_fonction);
ALTER TABLE Documents_reference ADD CONSTRAINT FK_Documents_reference_id_referentiel_de_formation FOREIGN KEY (id_referentiel_de_formation) REFERENCES Referentiel_de_formation(id_referentiel_de_formation);
ALTER TABLE Promotion ADD CONSTRAINT FK_Promotion_id_referentiel_de_formation FOREIGN KEY (id_referentiel_de_formation) REFERENCES Referentiel_de_formation(id_referentiel_de_formation);
ALTER TABLE Stagiaire ADD CONSTRAINT FK_Stagiaire_id_promotion FOREIGN KEY (id_promotion) REFERENCES Promotion(id_promotion);
ALTER TABLE Stagiaire ADD CONSTRAINT FK_Stagiaire_id_enseignant FOREIGN KEY (id_enseignant) REFERENCES Enseignant(id_enseignant);
ALTER TABLE Stage ADD CONSTRAINT FK_Stage_id_collaborateurs FOREIGN KEY (id_collaborateurs) REFERENCES Collaborateurs(id_collaborateurs);
ALTER TABLE Stage ADD CONSTRAINT FK_Stage_id_referentiel_de_formation FOREIGN KEY (id_referentiel_de_formation) REFERENCES Referentiel_de_formation(id_referentiel_de_formation);
ALTER TABLE Stage ADD CONSTRAINT FK_Stage_id_enseignant FOREIGN KEY (id_enseignant) REFERENCES Enseignant(id_enseignant);
ALTER TABLE Description_document ADD CONSTRAINT FK_Description_document_id_documents_reference FOREIGN KEY (id_documents_reference) REFERENCES Documents_reference(id_documents_reference);
ALTER TABLE Activite_et_visite ADD CONSTRAINT FK_Activite_et_visite_id_enseignant FOREIGN KEY (id_enseignant) REFERENCES Enseignant(id_enseignant);
ALTER TABLE Activite_et_visite ADD CONSTRAINT FK_Activite_et_visite_id_stagiaire FOREIGN KEY (id_stagiaire) REFERENCES Stagiaire(id_stagiaire);
ALTER TABLE Utilisateurs ADD CONSTRAINT FK_Utilisateurs_id_groupe FOREIGN KEY (id_groupe) REFERENCES Groupe(id_groupe);
ALTER TABLE Competences_evaluees ADD CONSTRAINT FK_Competences_evaluees_id_stagiaire FOREIGN KEY (id_stagiaire) REFERENCES Stagiaire(id_stagiaire);
ALTER TABLE Constituer ADD CONSTRAINT FK_Constituer_id_activite FOREIGN KEY (id_activite) REFERENCES Activite(id_activite);
ALTER TABLE Constituer ADD CONSTRAINT FK_Constituer_id_competence FOREIGN KEY (id_competence) REFERENCES Competence(id_competence);
ALTER TABLE Intervenir ADD CONSTRAINT FK_Intervenir_id_promotion FOREIGN KEY (id_promotion) REFERENCES Promotion(id_promotion);
ALTER TABLE Intervenir ADD CONSTRAINT FK_Intervenir_id_enseignant FOREIGN KEY (id_enseignant) REFERENCES Enseignant(id_enseignant);
ALTER TABLE Realiser ADD CONSTRAINT FK_Realiser_id_stagiaire FOREIGN KEY (id_stagiaire) REFERENCES Stagiaire(id_stagiaire);
ALTER TABLE Realiser ADD CONSTRAINT FK_Realiser_id_stage FOREIGN KEY (id_stage) REFERENCES Stage(id_stage);
ALTER TABLE employer ADD CONSTRAINT FK_employer_id_entreprise FOREIGN KEY (id_entreprise) REFERENCES Entreprise(id_entreprise);
ALTER TABLE employer ADD CONSTRAINT FK_employer_id_collaborateurs FOREIGN KEY (id_collaborateurs) REFERENCES Collaborateurs(id_collaborateurs);
ALTER TABLE Autoriser ADD CONSTRAINT FK_Autoriser_id_groupe FOREIGN KEY (id_groupe) REFERENCES Groupe(id_groupe);
ALTER TABLE Autoriser ADD CONSTRAINT FK_Autoriser_id_page FOREIGN KEY (id_page) REFERENCES Page(id_page);
