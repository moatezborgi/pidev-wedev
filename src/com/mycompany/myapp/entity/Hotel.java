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
public class Hotel {
    private String id;
    
    private String nom_hotel;
    
    private String ville_hotel;
    
    private int nb_etoile;
public Hotel()
{}

    public Hotel(String id, String nom_hotel, String ville_hotel, int nb_etoile) {
        this.id = id;
        this.nom_hotel = nom_hotel;
        this.ville_hotel = ville_hotel;
        this.nb_etoile = nb_etoile;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getNom_hotel() {
        return nom_hotel;
    }

    public void setNom_hotel(String nom_hotel) {
        this.nom_hotel = nom_hotel;
    }

    public String getVille_hotel() {
        return ville_hotel;
    }

    public void setVille_hotel(String ville_hotel) {
        this.ville_hotel = ville_hotel;
    }

    public int getNb_etoile() {
        return nb_etoile;
    }

    public void setNb_etoile(int nb_etoile) {
        this.nb_etoile = nb_etoile;
    }

    @Override
    public String toString() {
        return "hotel{" + "id=" + id + ", nom_hotel=" + nom_hotel + ", ville_hotel=" + ville_hotel + ", nb_etoile=" + nb_etoile + '}';
    }
    
    
    
}
