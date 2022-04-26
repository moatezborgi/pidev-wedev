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
public class Reservation {
    private int id;
    private String nom;
    private String prenom;
    private String date_reservation;
    private String time;
    private int nb_perso;
    private String telephone;
    private String refer_resto;

    public Reservation(int id, String nom, String prenom, String date_reservation, String time, int nb_perso, String telephone, String refer_resto) {
        this.id = id;
        this.nom = nom;
        this.prenom = prenom;
        this.date_reservation = date_reservation;
        this.time = time;
        this.nb_perso = nb_perso;
        this.telephone = telephone;
        this.refer_resto = refer_resto;
    }

    public Reservation(String nom, String prenom, String date_reservation, String time, int nb_perso, String telephone, String refer_resto) {
        this.nom = nom;
        this.prenom = prenom;
        this.date_reservation = date_reservation;
        this.time = time;
        this.nb_perso = nb_perso;
        this.telephone = telephone;
        this.refer_resto = refer_resto;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public String getPrenom() {
        return prenom;
    }

    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public String getDate_reservation() {
        return date_reservation;
    }

    public void setDate_reservation(String date_reservation) {
        this.date_reservation = date_reservation;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public int getNb_perso() {
        return nb_perso;
    }

    public void setNb_perso(int nb_perso) {
        this.nb_perso = nb_perso;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public String getRefer_resto() {
        return refer_resto;
    }

    public void setRefer_resto(String refer_resto) {
        this.refer_resto = refer_resto;
    }
    
    
    
    
}
