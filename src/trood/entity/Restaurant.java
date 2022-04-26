/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package trood.entity;

/**
 *
 * @author Rania
 */
public class Restaurant {
    private String refer_resto;
    private String nom_resto;
    private String adresse_resto;
    private String tel;
    private String nb_etoile;
    private String id_categorie;

    public Restaurant(String refer_resto, String nom_resto, String adresse_resto, String tel, String nb_etoile, String id_categorie) {
        this.refer_resto = refer_resto;
        this.nom_resto = nom_resto;
        this.adresse_resto = adresse_resto;
        this.tel = tel;
        this.nb_etoile = nb_etoile;
        this.id_categorie = id_categorie;
    }

 

    public String getRefer_resto() {
        return refer_resto;
    }

    public void setRefer_resto(String refer_resto) {
        this.refer_resto = refer_resto;
    }

    public String getNom_resto() {
        return nom_resto;
    }

    public void setNom_resto(String nom_resto) {
        this.nom_resto = nom_resto;
    }

    public String getAdresse_resto() {
        return adresse_resto;
    }

    public void setAdresse_resto(String adresse_resto) {
        this.adresse_resto = adresse_resto;
    }

    public String getTel() {
        return tel;
    }

    public void setTel(String tel) {
        this.tel = tel;
    }

    public String getNb_etoile() {
        return nb_etoile;
    }

    public void setNb_etoile(String nb_etoile) {
        this.nb_etoile = nb_etoile;
    }

    @Override
    public String toString() {
        return "Restaurant{" + "refer_resto=" + refer_resto + ", nom_resto=" + nom_resto + ", adresse_resto=" + adresse_resto + ", tel=" + tel + ", nb_etoile=" + nb_etoile + '}';
    }

    public String getId_categorie() {
        return id_categorie;
    }

    public void setId_categorie(String Id_categorie) {
        this.id_categorie = Id_categorie;
    }
    
    
				

				

			

			

	
    
}
