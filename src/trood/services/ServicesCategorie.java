/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package trood.services;

import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import trood.entity.Categorie;
import trood.utils.DataSource;

/**
 *
 * @author Rania
 */
public class ServicesCategorie implements IService<Categorie>{
     Connection cnx = DataSource.getInstance().getCnx();
           @Override

    public void ajouter(Categorie c) {
        try {
            String req = "INSERT INTO `categorie`(`lib_CAT`) VALUES ('"+c.getLib_cat()+"')";
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Categorie created !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void supprimer(String id) {
        try {
            String req = "DELETE FROM `categorie` WHERE  id = " + id;
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Categorie deleted !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void modifier(Categorie c) {
        try {
           String req = " UPDATE `categorie` SET `lib_cat`='" + c.getLib_cat() + "' WHERE id="+c.getId();
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Categorie updated !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
        @Override
    public List<Categorie> getAll() {
        List<Categorie> list = new ArrayList<>();
        try {
            String req = "Select `id`,  `lib_cat` from categorie";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while(rs.next()){
                Categorie c = new Categorie(((int)Float.parseFloat(rs.getString("id"))),rs.getString("lib_cat"));
                list.add(c);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }

   
}
