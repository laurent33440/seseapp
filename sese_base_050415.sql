-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 06 Avril 2015 à 10:58
-- Version du serveur: 5.5.41-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `lolobase`
--

-- --------------------------------------------------------

--
-- Structure de la table `Activite`
--

CREATE TABLE IF NOT EXISTS `Activite` (
  `id_activite` int(11) NOT NULL AUTO_INCREMENT,
  `act_ref_activite` varchar(20) DEFAULT NULL,
  `act_intitule_activite` varchar(20) DEFAULT NULL,
  `act_descriptif_activite` text,
  `act_est_realisee` tinyint(1) DEFAULT NULL,
  `id_referentiel_de_formation` int(11) DEFAULT NULL,
  `id_fonction` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_activite`),
  KEY `FK_Activite_id_referentiel_de_formation` (`id_referentiel_de_formation`),
  KEY `FK_Activite_id_fonction` (`id_fonction`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=398 ;

--
-- Contenu de la table `Activite`
--

INSERT INTO `Activite` (`id_activite`, `act_ref_activite`, `act_intitule_activite`, `act_descriptif_activite`, `act_est_realisee`, `id_referentiel_de_formation`, `id_fonction`) VALUES
(393, 'A3', NULL, 'Activité 3', 0, NULL, 15635),
(395, 'A100', NULL, 'Activité 10', 0, NULL, 15636),
(396, 'A100!!valeur dupliqu', NULL, 'Activité 10', 0, NULL, 15636),
(397, 'A100!!valeur dupliqu', NULL, 'Activité 10', 0, NULL, 15636);

-- --------------------------------------------------------

--
-- Structure de la table `Activite_et_visite`
--

CREATE TABLE IF NOT EXISTS `Activite_et_visite` (
  `id_activite_et_visite` int(11) NOT NULL AUTO_INCREMENT,
  `aev_date_activite` date DEFAULT NULL,
  `aev_description_activite` text,
  `aev_type_acteur` varchar(20) DEFAULT NULL,
  `aev_id_type_acteur` varchar(20) DEFAULT NULL,
  `id_enseignant` int(11) DEFAULT NULL,
  `id_stagiaire` int(11) DEFAULT NULL,
  `aev_date_visite` date DEFAULT NULL,
  PRIMARY KEY (`id_activite_et_visite`),
  KEY `FK_Activite_et_visite_id_enseignant` (`id_enseignant`),
  KEY `FK_Activite_et_visite_id_stagiaire` (`id_stagiaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Annee`
--

CREATE TABLE IF NOT EXISTS `Annee` (
  `annee_scolaire` year(4) NOT NULL DEFAULT '2015',
  PRIMARY KEY (`annee_scolaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Autoriser`
--

CREATE TABLE IF NOT EXISTS `Autoriser` (
  `type_droit` varchar(20) DEFAULT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  PRIMARY KEY (`id_groupe`,`id_page`),
  KEY `FK_Autoriser_id_page` (`id_page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Collaborateur`
--

CREATE TABLE IF NOT EXISTS `Collaborateur` (
  `id_collaborateur` int(11) NOT NULL AUTO_INCREMENT,
  `col_civilite` varchar(20) DEFAULT NULL,
  `col_nom` varchar(40) DEFAULT NULL,
  `col_prenom` varchar(40) DEFAULT NULL,
  `col_mel` varchar(40) DEFAULT NULL,
  `col_tel` varchar(20) DEFAULT NULL,
  `col_role_entreprise` varchar(40) DEFAULT NULL,
  `col_compte` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_collaborateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Competence`
--

CREATE TABLE IF NOT EXISTS `Competence` (
  `id_competence` int(11) NOT NULL AUTO_INCREMENT,
  `comp_ref_competence` varchar(20) DEFAULT NULL,
  `comp_intitule_competence` varchar(20) DEFAULT NULL,
  `comp_descriptif_competence` tinytext,
  `comp_est_evaluable` tinyint(1) DEFAULT NULL,
  `comp_est_evaluee` tinyint(1) DEFAULT NULL,
  `comp_niveau_competence` varchar(20) DEFAULT NULL,
  `comp_niveau_autonomie` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_competence`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=694 ;

--
-- Contenu de la table `Competence`
--

INSERT INTO `Competence` (`id_competence`, `comp_ref_competence`, `comp_intitule_competence`, `comp_descriptif_competence`, `comp_est_evaluable`, `comp_est_evaluee`, `comp_niveau_competence`, `comp_niveau_autonomie`) VALUES
(691, 'C1', NULL, 'savoir lire', 1, 0, '10', '10'),
(692, 'C2', NULL, 'savoie écrire', 1, 0, '10', '10'),
(693, 'C3', NULL, 'savoir chanter', 1, 0, '10', '10');

-- --------------------------------------------------------

--
-- Structure de la table `Competences_evaluees`
--

CREATE TABLE IF NOT EXISTS `Competences_evaluees` (
  `id_competences_realisees` int(11) NOT NULL AUTO_INCREMENT,
  `coe_annee_evaluation` year(4) DEFAULT NULL,
  `coe_ref_competence_evaluee` varchar(20) DEFAULT NULL,
  `coe_intitule_competence_evaluee` varchar(20) DEFAULT NULL,
  `coe_descriptif_competence_evaluee` tinytext,
  `coe_niveau_competence` int(11) DEFAULT NULL,
  `coe_niveau_autonomie` int(11) DEFAULT NULL,
  `id_stagiaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_competences_realisees`),
  KEY `FK_Competences_evaluees_id_stagiaire` (`id_stagiaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Constituer`
--

CREATE TABLE IF NOT EXISTS `Constituer` (
  `id_activite` int(11) NOT NULL,
  `id_competence` int(11) NOT NULL,
  PRIMARY KEY (`id_activite`,`id_competence`),
  KEY `FK_Constituer_id_competence` (`id_competence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Constituer`
--

INSERT INTO `Constituer` (`id_activite`, `id_competence`) VALUES
(393, 691),
(393, 692),
(393, 693);

-- --------------------------------------------------------

--
-- Structure de la table `Description_document`
--

CREATE TABLE IF NOT EXISTS `Description_document` (
  `id_description_document` int(11) NOT NULL AUTO_INCREMENT,
  `ddo_description_doc` text,
  `id_documents_reference` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_description_document`),
  KEY `FK_Description_document_id_documents_reference` (`id_documents_reference`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Documents_reference`
--

CREATE TABLE IF NOT EXISTS `Documents_reference` (
  `id_documents_reference` int(11) NOT NULL AUTO_INCREMENT,
  `drf_sujet` varchar(25) DEFAULT NULL,
  `id_referentiel_de_formation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_documents_reference`),
  KEY `FK_Documents_reference_id_referentiel_de_formation` (`id_referentiel_de_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Employer`
--

CREATE TABLE IF NOT EXISTS `Employer` (
  `id_entreprise` int(11) NOT NULL,
  `id_collaborateur` int(11) NOT NULL,
  PRIMARY KEY (`id_entreprise`,`id_collaborateur`),
  KEY `FK_Employer_id_collaborateur` (`id_collaborateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Enseignant`
--

CREATE TABLE IF NOT EXISTS `Enseignant` (
  `id_enseignant` int(11) NOT NULL AUTO_INCREMENT,
  `ens_civilite_enseignant` varchar(20) DEFAULT NULL,
  `ens_nom_enseignant` varchar(40) DEFAULT NULL,
  `ens_prenom_enseignant` varchar(40) DEFAULT NULL,
  `ens_mel_enseignant` varchar(40) DEFAULT NULL,
  `ens_adresse1_enseignant` varchar(64) DEFAULT NULL,
  `ens_adresse2_enseignant` varchar(64) DEFAULT NULL,
  `ens_url_enseignant` varchar(40) DEFAULT NULL,
  `ens_cp_enseignant` int(11) DEFAULT NULL,
  `ens_discipline` varchar(40) DEFAULT NULL,
  `ens_role` varchar(20) DEFAULT NULL,
  `ens_est_referant` tinyint(1) DEFAULT NULL,
  `ens_compte_enseignant` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_enseignant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `Enseignant`
--

INSERT INTO `Enseignant` (`id_enseignant`, `ens_civilite_enseignant`, `ens_nom_enseignant`, `ens_prenom_enseignant`, `ens_mel_enseignant`, `ens_adresse1_enseignant`, `ens_adresse2_enseignant`, `ens_url_enseignant`, `ens_cp_enseignant`, `ens_discipline`, `ens_role`, `ens_est_referant`, `ens_compte_enseignant`) VALUES
(21, NULL, 'zola', 'emile', 'l', NULL, NULL, NULL, NULL, 'français', NULL, NULL, NULL),
(22, NULL, 'a', 'a', 'lolo@ici.fr', NULL, NULL, NULL, NULL, 'français', NULL, NULL, NULL),
(23, NULL, 'authier', 'laurent', 'lolo@ici.fr', NULL, NULL, NULL, NULL, 'electronique', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Entreprise`
--

CREATE TABLE IF NOT EXISTS `Entreprise` (
  `id_entreprise` int(11) NOT NULL AUTO_INCREMENT,
  `ent_nom_entreprise` varchar(40) DEFAULT NULL,
  `ent_nom_commercial` varchar(40) DEFAULT NULL,
  `ent_siret` varchar(40) DEFAULT NULL,
  `ent_activite` varchar(40) DEFAULT NULL,
  `ent_profil` varchar(40) DEFAULT NULL,
  `ent_stagiaires_recus` text,
  `ent_commentaire` text,
  `ent_date_enregistrement` date DEFAULT NULL,
  `ent_adresse1_entreprise` varchar(40) DEFAULT NULL,
  `ent_adresse2_entreprise` varchar(40) DEFAULT NULL,
  `ent_ville_entreprise` varchar(40) DEFAULT NULL,
  `ent_cp_entreprise` int(11) DEFAULT NULL,
  `ent_pays_entreprise` varchar(40) DEFAULT NULL,
  `ent_url_entreprise` varchar(40) DEFAULT NULL,
  `ent_telephone_entreprise` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Etablissement`
--

CREATE TABLE IF NOT EXISTS `Etablissement` (
  `id_etablissement` int(11) NOT NULL AUTO_INCREMENT,
  `eta_nom_etablissement` varchar(40) DEFAULT NULL,
  `eta_siret_etablissement` varchar(40) DEFAULT NULL,
  `eta_adresse1_etablissement` varchar(64) DEFAULT NULL,
  `eta_adresse2_etablissement` varchar(64) DEFAULT NULL,
  `eta_ville_etablissement` varchar(20) DEFAULT NULL,
  `eta_cp_etablissement` int(11) DEFAULT NULL,
  `eta_url_etablissement` varchar(40) DEFAULT NULL,
  `eta_mel_etablissement` varchar(40) DEFAULT NULL,
  `eta_telephone_etablissement` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_etablissement`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Etablissement`
--

INSERT INTO `Etablissement` (`id_etablissement`, `eta_nom_etablissement`, `eta_siret_etablissement`, `eta_adresse1_etablissement`, `eta_adresse2_etablissement`, `eta_ville_etablissement`, `eta_cp_etablissement`, `eta_url_etablissement`, `eta_mel_etablissement`, `eta_telephone_etablissement`) VALUES
(1, 'Lycee Philadelphe de Gerde', '12345', '3 Allée Philadelphe de Gerde', '2 rue', 'Pessac', 33600, 'a.edu', 'etab@a.fr', 5050505);

-- --------------------------------------------------------

--
-- Structure de la table `Fonction`
--

CREATE TABLE IF NOT EXISTS `Fonction` (
  `id_fonction` int(11) NOT NULL AUTO_INCREMENT,
  `f_description` text,
  PRIMARY KEY (`id_fonction`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15637 ;

--
-- Contenu de la table `Fonction`
--

INSERT INTO `Fonction` (`id_fonction`, `f_description`) VALUES
(15634, 'fonc2017'),
(15635, 'fonc3'),
(15636, 'fonc4');

-- --------------------------------------------------------

--
-- Structure de la table `Groupe`
--

CREATE TABLE IF NOT EXISTS `Groupe` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `grp_nom_groupe` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `Groupe`
--

INSERT INTO `Groupe` (`id_groupe`, `grp_nom_groupe`) VALUES
(1, 'administrateur'),
(2, 'enseignant'),
(3, 'tuteur'),
(4, 'stagiaire');

-- --------------------------------------------------------

--
-- Structure de la table `Intervenir`
--

CREATE TABLE IF NOT EXISTS `Intervenir` (
  `annee` year(4) DEFAULT NULL,
  `id_promotion` int(11) NOT NULL,
  `id_enseignant` int(11) NOT NULL,
  PRIMARY KEY (`id_promotion`,`id_enseignant`),
  KEY `FK_Intervenir_id_enseignant` (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Intervenir`
--

INSERT INTO `Intervenir` (`annee`, `id_promotion`, `id_enseignant`) VALUES
(2015, 3, 21);

-- --------------------------------------------------------

--
-- Structure de la table `Page`
--

CREATE TABLE IF NOT EXISTS `Page` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `pge_nom_page` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Parametres`
--

CREATE TABLE IF NOT EXISTS `Parametres` (
  `id_parametre` int(11) NOT NULL AUTO_INCREMENT,
  `par_code_parametre` varchar(40) DEFAULT NULL,
  `par_libelle_parametre` varchar(40) DEFAULT NULL,
  `par_valeur_parametre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_parametre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `Parametres`
--

INSERT INTO `Parametres` (`id_parametre`, `par_code_parametre`, `par_libelle_parametre`, `par_valeur_parametre`) VALUES
(1, 'user_con', '10', 'administrateur'),
(2, 'user_connected', '10', 'administrateur'),
(3, 'user_connected', '11', 'administrateur'),
(4, 'user_connected', 'dieu', 'administrateur'),
(5, 'user_connected', 'lolo', 'administrateur'),
(6, 'user_connected', 'dieu', 'administrateur'),
(7, 'user_connected', 'dieu', 'administrateur'),
(8, 'user_connected', 'dieu', 'administrateur'),
(9, 'user_connected', 'dieu', 'administrateur'),
(10, 'user_connected', 'dieu', 'administrateur'),
(11, 'user_connected', 'dieu', 'administrateur'),
(12, 'user_connected', 'dieu', 'administrateur'),
(13, 'user_connected', 'lolo', 'administrateur'),
(14, 'user_connected', 'lolo', 'administrateur'),
(15, 'user_connected', 'lolo', 'administrateur'),
(16, 'user_connected', 'lolo', 'administrateur'),
(17, 'user_connected', 'lolo', 'administrateur'),
(18, 'user_connected', 'lolo', 'administrateur'),
(19, 'user_connected', 'lolo', 'administrateur'),
(20, 'user_connected', 'lolo', 'administrateur'),
(21, 'user_connected', 'lolo', 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `Promotion`
--

CREATE TABLE IF NOT EXISTS `Promotion` (
  `id_promotion` int(11) NOT NULL AUTO_INCREMENT,
  `pro_nom_promotion` varchar(20) DEFAULT NULL,
  `pro_reference_promotion` varchar(20) DEFAULT NULL,
  `id_referentiel_de_formation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_promotion`),
  KEY `FK_Promotion_id_referentiel_de_formation` (`id_referentiel_de_formation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `Promotion`
--

INSERT INTO `Promotion` (`id_promotion`, `pro_nom_promotion`, `pro_reference_promotion`, `id_referentiel_de_formation`) VALUES
(3, 'promo3', 'ref3', NULL),
(6, 'promo2015', 'ref2015', NULL),
(7, '2 SEN', 'SEN', NULL),
(8, 'terminale sen', 'tsen', NULL),
(9, 'premiere sen', '1sen', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Realiser`
--

CREATE TABLE IF NOT EXISTS `Realiser` (
  `id_stagiaire` int(11) NOT NULL,
  `id_stage_defini` int(11) NOT NULL,
  PRIMARY KEY (`id_stagiaire`,`id_stage_defini`),
  KEY `FK_Realiser_id_stage_defini` (`id_stage_defini`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Reference`
--

CREATE TABLE IF NOT EXISTS `Reference` (
  `id_reference` int(11) NOT NULL AUTO_INCREMENT,
  `ref_type_ref` varchar(20) DEFAULT NULL,
  `ref_code_ref` varchar(20) DEFAULT NULL,
  `ref_libelle_ref` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_reference`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Referentiel_de_formation`
--

CREATE TABLE IF NOT EXISTS `Referentiel_de_formation` (
  `id_referentiel_de_formation` int(11) NOT NULL AUTO_INCREMENT,
  `rdf_nom_formation` varchar(20) DEFAULT NULL,
  `rdf_domaine_formation` varchar(20) DEFAULT NULL,
  `rdf_reference` varchar(20) DEFAULT NULL,
  `rdf_intitule` varchar(20) DEFAULT NULL,
  `rdf_descriptif` text,
  `rdf_duree_formation` int(11) DEFAULT NULL,
  `rdf_nombre_jours_stage` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_referentiel_de_formation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `Referentiel_de_formation`
--

INSERT INTO `Referentiel_de_formation` (`id_referentiel_de_formation`, `rdf_nom_formation`, `rdf_domaine_formation`, `rdf_reference`, `rdf_intitule`, `rdf_descriptif`, `rdf_duree_formation`, `rdf_nombre_jours_stage`) VALUES
(1, 'Bac Pro SEN', 'système electronique', 'SEN', 'SEN', 'SEN ....', 3, 110),
(2, 'Vente', 'Vente', 'MRC', 'vente', 'ggggggg', 12, 105),
(3, 'Vente', 'Vente', 'MRC', 'vente', 'ggggggg', 12, 105),
(4, 'Vente', 'Vente', 'MRC', 'v', 'pour la vente', 36, 105),
(5, 'Vente', 'Vente', 'm', 'vente', 'pour la vente', 999, 1132131),
(6, '', '', '', '', '', 0, 0),
(7, '', '', '', '', '', 0, 0),
(8, '', '', '', '', '', 0, 0),
(9, '', '', '', '', '', 0, 0),
(10, '', '', '', '', '', 0, 0),
(11, '', '', '', '', '', 0, 0),
(12, '', '', '', '', '', 0, 0),
(13, '', '', '', '', '', 0, 0),
(14, '', '', '', '', '', 0, 0),
(15, '', '', '', '', '', 0, 0),
(16, '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Stage`
--

CREATE TABLE IF NOT EXISTS `Stage` (
  `id_stage` int(11) NOT NULL AUTO_INCREMENT,
  `stg_denomination_periode` varchar(40) DEFAULT NULL,
  `stg_date_debut` date DEFAULT NULL,
  `stg_date_fin` date DEFAULT NULL,
  `stg_annee` year(4) DEFAULT NULL,
  `id_referentiel_de_formation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stage`),
  KEY `FK_Stage_id_referentiel_de_formation` (`id_referentiel_de_formation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Stage_defini`
--

CREATE TABLE IF NOT EXISTS `Stage_defini` (
  `id_stage_defini` int(11) NOT NULL AUTO_INCREMENT,
  `stgdef_est_ouvrable` tinyint(1) DEFAULT NULL,
  `stgdef_status` varchar(20) DEFAULT NULL,
  `stgdef_commentaire_tuteur` text,
  `id_stage` int(11) DEFAULT NULL,
  `id_collaborateur` int(11) DEFAULT NULL,
  `id_enseignant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stage_defini`),
  KEY `FK_Stage_defini_id_stage` (`id_stage`),
  KEY `FK_Stage_defini_id_collaborateur` (`id_collaborateur`),
  KEY `FK_Stage_defini_id_enseignant` (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `Stagiaire`
--

CREATE TABLE IF NOT EXISTS `Stagiaire` (
  `id_stagiaire` int(11) NOT NULL AUTO_INCREMENT,
  `sta_civilite_stagiaire` varchar(20) DEFAULT NULL,
  `sta_nom_stagiaire` varchar(40) DEFAULT NULL,
  `sta_prenom_stagiaire` varchar(40) DEFAULT NULL,
  `sta_mel_stagiaire` varchar(40) DEFAULT NULL,
  `sta_adresse1_stagiaire` varchar(40) DEFAULT NULL,
  `sta_adresse2_stagiaire` varchar(40) DEFAULT NULL,
  `sta_url_stagiaire` varchar(40) DEFAULT NULL,
  `sta_cp_stagiaire` int(11) DEFAULT NULL,
  `sta_civilite_resp_legal` varchar(20) DEFAULT NULL,
  `sta_nom_resp_legal` varchar(40) DEFAULT NULL,
  `sta_prenom_resp_legal` varchar(40) DEFAULT NULL,
  `sta_mel_resp_legal` varchar(40) DEFAULT NULL,
  `sta_adresse1_resp_legal` varchar(40) DEFAULT NULL,
  `sta_adresse2_resp_legal` varchar(40) DEFAULT NULL,
  `sta_url_resp_legal` varchar(40) DEFAULT NULL,
  `sta_cp_resp_legal` int(11) DEFAULT NULL,
  `sta_affiliation` varchar(40) DEFAULT NULL,
  `id_promotion` int(11) DEFAULT NULL,
  `id_enseignant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stagiaire`),
  KEY `FK_Stagiaire_id_promotion` (`id_promotion`),
  KEY `FK_Stagiaire_id_enseignant` (`id_enseignant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Stagiaire`
--

INSERT INTO `Stagiaire` (`id_stagiaire`, `sta_civilite_stagiaire`, `sta_nom_stagiaire`, `sta_prenom_stagiaire`, `sta_mel_stagiaire`, `sta_adresse1_stagiaire`, `sta_adresse2_stagiaire`, `sta_url_stagiaire`, `sta_cp_stagiaire`, `sta_civilite_resp_legal`, `sta_nom_resp_legal`, `sta_prenom_resp_legal`, `sta_mel_resp_legal`, `sta_adresse1_resp_legal`, `sta_adresse2_resp_legal`, `sta_url_resp_legal`, `sta_cp_resp_legal`, `sta_affiliation`, `id_promotion`, `id_enseignant`) VALUES
(5, NULL, 'kevin', 'bryan', 'stage@ici.fr', NULL, NULL, '0556565630', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE IF NOT EXISTS `Utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `uti_identifiant` varchar(20) DEFAULT NULL,
  `uti_mot_de_passe` varchar(40) DEFAULT NULL,
  `uti_mel` varchar(40) DEFAULT NULL,
  `uti_etat_compte` varchar(20) DEFAULT NULL,
  `uti_derniere_connexion` datetime DEFAULT NULL,
  `id_groupe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `FK_Utilisateurs_id_groupe` (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`id_utilisateur`, `uti_identifiant`, `uti_mot_de_passe`, `uti_mel`, `uti_etat_compte`, `uti_derniere_connexion`, `id_groupe`) VALUES
(10, 'dieu', 'dieu', 'dieu@ciel.org', 'actif', '0000-00-00 00:00:00', 1),
(11, 'lolo', 'laurent', 'lolo@moi.fr', 'actif', '0000-00-00 00:00:00', 1),
(16, 'l', 'l', 'l', NULL, NULL, 2),
(23, 'stage@ici.fr', 'stage@ici.fr', 'stage@ici.fr', NULL, NULL, 4);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Activite`
--
ALTER TABLE `Activite`
  ADD CONSTRAINT `FK_Activite_id_fonction` FOREIGN KEY (`id_fonction`) REFERENCES `Fonction` (`id_fonction`),
  ADD CONSTRAINT `FK_Activite_id_referentiel_de_formation` FOREIGN KEY (`id_referentiel_de_formation`) REFERENCES `Referentiel_de_formation` (`id_referentiel_de_formation`);

--
-- Contraintes pour la table `Activite_et_visite`
--
ALTER TABLE `Activite_et_visite`
  ADD CONSTRAINT `FK_Activite_et_visite_id_enseignant` FOREIGN KEY (`id_enseignant`) REFERENCES `Enseignant` (`id_enseignant`),
  ADD CONSTRAINT `FK_Activite_et_visite_id_stagiaire` FOREIGN KEY (`id_stagiaire`) REFERENCES `Stagiaire` (`id_stagiaire`);

--
-- Contraintes pour la table `Autoriser`
--
ALTER TABLE `Autoriser`
  ADD CONSTRAINT `FK_Autoriser_id_groupe` FOREIGN KEY (`id_groupe`) REFERENCES `Groupe` (`id_groupe`),
  ADD CONSTRAINT `FK_Autoriser_id_page` FOREIGN KEY (`id_page`) REFERENCES `Page` (`id_page`);

--
-- Contraintes pour la table `Competences_evaluees`
--
ALTER TABLE `Competences_evaluees`
  ADD CONSTRAINT `FK_Competences_evaluees_id_stagiaire` FOREIGN KEY (`id_stagiaire`) REFERENCES `Stagiaire` (`id_stagiaire`);

--
-- Contraintes pour la table `Constituer`
--
ALTER TABLE `Constituer`
  ADD CONSTRAINT `FK_Constituer_id_activite` FOREIGN KEY (`id_activite`) REFERENCES `Activite` (`id_activite`),
  ADD CONSTRAINT `FK_Constituer_id_competence` FOREIGN KEY (`id_competence`) REFERENCES `Competence` (`id_competence`);

--
-- Contraintes pour la table `Description_document`
--
ALTER TABLE `Description_document`
  ADD CONSTRAINT `FK_Description_document_id_documents_reference` FOREIGN KEY (`id_documents_reference`) REFERENCES `Documents_reference` (`id_documents_reference`);

--
-- Contraintes pour la table `Documents_reference`
--
ALTER TABLE `Documents_reference`
  ADD CONSTRAINT `FK_Documents_reference_id_referentiel_de_formation` FOREIGN KEY (`id_referentiel_de_formation`) REFERENCES `Referentiel_de_formation` (`id_referentiel_de_formation`);

--
-- Contraintes pour la table `Employer`
--
ALTER TABLE `Employer`
  ADD CONSTRAINT `FK_Employer_id_collaborateur` FOREIGN KEY (`id_collaborateur`) REFERENCES `Collaborateur` (`id_collaborateur`),
  ADD CONSTRAINT `FK_Employer_id_entreprise` FOREIGN KEY (`id_entreprise`) REFERENCES `Entreprise` (`id_entreprise`);

--
-- Contraintes pour la table `Intervenir`
--
ALTER TABLE `Intervenir`
  ADD CONSTRAINT `FK_Intervenir_id_enseignant` FOREIGN KEY (`id_enseignant`) REFERENCES `Enseignant` (`id_enseignant`),
  ADD CONSTRAINT `FK_Intervenir_id_promotion` FOREIGN KEY (`id_promotion`) REFERENCES `Promotion` (`id_promotion`);

--
-- Contraintes pour la table `Promotion`
--
ALTER TABLE `Promotion`
  ADD CONSTRAINT `FK_Promotion_id_referentiel_de_formation` FOREIGN KEY (`id_referentiel_de_formation`) REFERENCES `Referentiel_de_formation` (`id_referentiel_de_formation`);

--
-- Contraintes pour la table `Realiser`
--
ALTER TABLE `Realiser`
  ADD CONSTRAINT `FK_Realiser_id_stage_defini` FOREIGN KEY (`id_stage_defini`) REFERENCES `Stage_defini` (`id_stage_defini`),
  ADD CONSTRAINT `FK_Realiser_id_stagiaire` FOREIGN KEY (`id_stagiaire`) REFERENCES `Stagiaire` (`id_stagiaire`);

--
-- Contraintes pour la table `Stage`
--
ALTER TABLE `Stage`
  ADD CONSTRAINT `FK_Stage_id_referentiel_de_formation` FOREIGN KEY (`id_referentiel_de_formation`) REFERENCES `Referentiel_de_formation` (`id_referentiel_de_formation`);

--
-- Contraintes pour la table `Stage_defini`
--
ALTER TABLE `Stage_defini`
  ADD CONSTRAINT `FK_Stage_defini_id_enseignant` FOREIGN KEY (`id_enseignant`) REFERENCES `Enseignant` (`id_enseignant`),
  ADD CONSTRAINT `FK_Stage_defini_id_collaborateur` FOREIGN KEY (`id_collaborateur`) REFERENCES `Collaborateur` (`id_collaborateur`),
  ADD CONSTRAINT `FK_Stage_defini_id_stage` FOREIGN KEY (`id_stage`) REFERENCES `Stage` (`id_stage`);

--
-- Contraintes pour la table `Stagiaire`
--
ALTER TABLE `Stagiaire`
  ADD CONSTRAINT `FK_Stagiaire_id_enseignant` FOREIGN KEY (`id_enseignant`) REFERENCES `Enseignant` (`id_enseignant`),
  ADD CONSTRAINT `FK_Stagiaire_id_promotion` FOREIGN KEY (`id_promotion`) REFERENCES `Promotion` (`id_promotion`);

--
-- Contraintes pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD CONSTRAINT `FK_Utilisateurs_id_groupe` FOREIGN KEY (`id_groupe`) REFERENCES `Groupe` (`id_groupe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
