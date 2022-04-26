 /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package trood.services;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import trood.entity.Restaurant;
import trood.utils.DataSource;


/**
 *
 * @author Rania
 */
public class ServicesRestaurant implements IService<Restaurant> {
     Connection cnx = DataSource.getInstance().getCnx();
           @Override

    public void ajouter(Restaurant r) {
        try {
            String req = "INSERT INTO `restaurant`(`refer_resto`,`nom_resto`, `adresse_resto`, `tel`, `nb_etoile`,`categorie_id`) VALUES ('"+r.getRefer_resto()+"','"+r.getNom_resto()+"','"+r.getAdresse_resto()+"','"+r.getTel()+"','"+r.getNb_etoile()+"','"+r.getId_categorie()+"')";
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Restaurant created !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void supprimer(String id) {
        try {
            String req = "DELETE FROM `restaurant` WHERE  refer_resto = " + id;
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Restaurant deleted !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void modifier(Restaurant r) {
        try {
           String req = " UPDATE `restaurant` SET `refer_resto`='" + r.getRefer_resto() + "',`nom_resto`='" + r.getNom_resto() + "',`adresse_resto`='" + r.getAdresse_resto() + "',`tel`='" + r.getTel() + "',`nb_etoile`='" + r.getNb_etoile() + "' ,`categorie_id`='"+r.getId_categorie()+"' WHERE refer_resto="+r.getRefer_resto();
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Restaurant updated !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
        @Override
    public List<Restaurant> getAll() {
        List<Restaurant> list = new ArrayList<>();
        try {
            String req = "Select `refer_resto`,  `nom_resto`, `adresse_resto`, `tel`, `nb_etoile`,`categorie_id` from restaurant";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while(rs.next()){
                Restaurant r = new Restaurant(rs.getString("refer_resto"),rs.getString("nom_resto"),rs.getString("adresse_resto"),rs.getString("tel"),rs.getString("nb_etoile"),rs.getString("categorie_id"));
                list.add(r);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
}
