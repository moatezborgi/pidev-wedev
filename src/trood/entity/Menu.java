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
public class Menu {
    private int codmenu;
    private String lib_plat;
    private double prix_plat;
    private String refer_resto;
    private String nom_plat;
    private String id_categorie;

    public Menu(int codmenu, String lib_plat, double prix_plat, String refer_resto, String nom_plat, String id_categorie) {
        this.codmenu = codmenu;
        this.lib_plat = lib_plat;
        this.prix_plat = prix_plat;
        this.refer_resto = refer_resto;
        this.nom_plat = nom_plat;
        this.id_categorie = id_categorie;
    }

 

    public int getCodmenu() {
        return codmenu;
    }

    public void setCodmenu(int codmenu) {
        this.codmenu = codmenu;
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

    public String getRefer_resto() {
        return refer_resto;
    }

    public void setRefer_resto(String refer_resto) {
        this.refer_resto = refer_resto;
    }

    public String getNom_plat() {
        return nom_plat;
    }

    public void setNom_plat(String nom_plat) {
        this.nom_plat = nom_plat;
    }

    @Override
    public String toString() {
        return "Menu{" + "codmenu=" + codmenu + ", lib_plat=" + lib_plat + ", prix_plat=" + prix_plat + ", refer_resto=" + refer_resto + ", nom_plat=" + nom_plat + '}';
    }

    public Menu(String lib_plat, double prix_plat, String refer_resto, String nom_plat, String id_categorie) {
        this.lib_plat = lib_plat;
        this.prix_plat = prix_plat;
        this.refer_resto = refer_resto;
        this.nom_plat = nom_plat;
        this.id_categorie = id_categorie;
    }

    public String getId_categorie() {
        return id_categorie;
    }

    public void setId_categorie(String id_categorie) {
        this.id_categorie = id_categorie;
    }

 
    
    
    
}
