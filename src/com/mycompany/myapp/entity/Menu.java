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
public class Menu {
    
    private int codemenu;
    private String lib_plat;
    private double prix_plat;
    private String nom_plat;
    public Menu(String lib_plat, double prix_plat, String nom_plat) {
        this.lib_plat = lib_plat;
        this.prix_plat = prix_plat;
        this.nom_plat = nom_plat;
    }

    public Menu(int codemenu, String lib_plat, double prix_plat, String nom_plat) {
        this.codemenu = codemenu;
        this.lib_plat = lib_plat;
        this.prix_plat = prix_plat;
        this.nom_plat = nom_plat;
    }

    public Menu() {
       
    }

    public int getCodemenu() {
        return codemenu;
    }

    public void setCodemenu(int codemenu) {
        this.codemenu = codemenu;
    }


    public String getLib_plat() {
        return lib_plat;
    }

    public void setLib_plat(String lib_plat) {
        this.lib_plat = lib_plat;
    }

    public double getPrix_plat() {
        return prix_plat;
    }

    public void setPrix_plat(double prix_plat) {
        this.prix_plat = prix_plat;
    }

    public String getNom_plat() {
        return nom_plat;
    }

    public void setNom_plat(String nom_plat) {
        this.nom_plat = nom_plat;
    }
    

   
    
}
