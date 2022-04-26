/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package trood;


import trood.entity.Categorie;
import trood.entity.Menu;
import trood.entity.Reservation;
import trood.entity.Restaurant;
import trood.services.ServicesCategorie;
import trood.services.ServicesMenu;
import trood.services.ServicesReservation;
import trood.services.ServicesRestaurant;

/**
 *
 * @author Rania
 */
public class Trood {
    
  
    public static void main(String[] args) {
        //Restaurant r1= new Restaurant("1223","rania","aaaaaar","22222222","6");
        //ServicesRestaurant sr= new ServicesRestaurant();
        //sr.ajouter(r1);
        //sr.modifier(r1);
        //sr.supprimer("122");
        //System.out.println(sr.getAll());
        
        Menu m1= new Menu("pate avec fruit de mer",12,"resto357951","pate","6");
        //Menu m2= new Menu(20,"pate avec fruit de mer",12,"resto357951","pate");
        ServicesMenu sm= new ServicesMenu();
        sm.ajouter(m1);
        //sm.modifier(m2);
        //sm.supprimer("20");
        
        //Categorie c1= new Categorie("tounsi");
        //Categorie c2= new Categorie(7,"tounsiiiiii");
        //ServicesCategorie sc= new ServicesCategorie();
        //sc.ajouter(c1);
        //sc.modifier(c2);
        //sc.supprimer("7");
        
        //Reservation re1= new Reservation("rania","amri","2022-12-01","12:25",2,"12345678","1223");
       // Reservation re2= new Reservation(10,"moatez","amri","2022-12-01","12:25",2,"12345678","1223");
      //  ServicesReservation sre= new ServicesReservation();
        //sre.ajouter(re1);
        //sre.modifier(re2);
        //sre.supprimer("10");
        
     
    }
    
}
