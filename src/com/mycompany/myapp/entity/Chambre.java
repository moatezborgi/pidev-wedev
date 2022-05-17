/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.entity;

/**
 *
 * @author MSI
 */
public class Chambre {
    private int num_chambre; 
    private String type_chambre;
    private int nb_lits;
    private String dispo;
    private String vue;
    private float prix;
        private String refer_hotel;

    public Chambre(int num_chambre, String type_chambre, int nb_lits, String dispo, String vue, float prix, String refer_hotel) {
        this.num_chambre = num_chambre;
        this.type_chambre = type_chambre;
        this.nb_lits = nb_lits;
        this.dispo = dispo;
        this.vue = vue;
        this.prix = prix;
        this.refer_hotel = refer_hotel;
    }

    public Chambre() {
        
     }

    public int getNum_chambre() {
        return num_chambre;
    }

    public void setNum_chambre(int num_chambre) {
        this.num_chambre = num_chambre;
    }

    public String getType_chambre() {
        return type_chambre;
    }

    public void setType_chambre(String type_chambre) {
        this.type_chambre = type_chambre;
    }

    public int getNb_lits() {
        return nb_lits;
    }

    public void setNb_lits(int nb_lits) {
        this.nb_lits = nb_lits;
    }

    public String getDispo() {
        return dispo;
    }

    public void setDispo(String dispo) {
        this.dispo = dispo;
    }

    public String getVue() {
        return vue;
    }

    public void setVue(String vue) {
        this.vue = vue;
    }

    public float getPrix() {
        return prix;
    }

    public void setPrix(float prix) {
        this.prix = prix;
    }

    public String getRefer_hotel() {
        return refer_hotel;
    }

    public void setRefer_hotel(String refer_hotel) {
        this.refer_hotel = refer_hotel;
    }

    @Override
    public String toString() {
        return "Chambre{" + "num_chambre=" + num_chambre + ", type_chambre=" + type_chambre + ", nb_lits=" + nb_lits + ", dispo=" + dispo + ", vue=" + vue + ", prix=" + prix + ", refer_hotel=" + refer_hotel + '}';
    }

 
}
