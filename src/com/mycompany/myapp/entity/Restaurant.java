/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.entity;

/**
 *
 * @author Rania
 */
public class Restaurant {
    
    private String refer_resto;
    private String nom_resto;
    private String tel;
    private String adresse;
    private String nb_etoile;
    

    public Restaurant() {
        
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

    public String getTel() {
        return tel;
    }

    public void setTel(String tel) {
        this.tel = tel;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public String getNb_etoile() {
        return nb_etoile;
    }

    public void setNb_etoile(String nb_etoile) {
        this.nb_etoile = nb_etoile;
    }

    public Restaurant(String refer_resto, String nom_resto, String tel, String adresse, String nb_etoile) {
        this.refer_resto = refer_resto;
        this.nom_resto = nom_resto;
        this.tel = tel;
        this.adresse = adresse;
        this.nb_etoile = nb_etoile;
    }
    
}
