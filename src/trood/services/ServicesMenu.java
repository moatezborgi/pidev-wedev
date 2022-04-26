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
import trood.utils.DataSource;

import trood.entity.Menu;


/**
 *
 * @author Rania
 */
public class ServicesMenu implements IService<Menu> {
    
     Connection cnx = DataSource.getInstance().getCnx();
           @Override

    public void ajouter(Menu m) {
        try {
            String req = "INSERT INTO `menu`(`lib_plat`, `prix_plat`, `refer_resto`, `nom_plat`,`categorie_id`) VALUES ('"+m.getLib_plat()+"','"+m.getPrix_plat()+"','"+m.getRefer_resto()+"','"+m.getNom_plat()+"','"+m.getId_categorie()+"')";
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Menu created !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void supprimer(String id) {
        try {
            String req = "DELETE FROM `menu` WHERE  codmenu = " + id;
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Menu deleted !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void modifier(Menu m) {
        try {
           String req = " UPDATE `menu` SET `lib_plat`='" + m.getLib_plat() + "',`prix_plat`='" + m.getPrix_plat() + "',`refer_resto`='" + m.getRefer_resto() + "',`nom_plat`='" + m.getNom_plat() + "', `categorie_id`= '"+m.getId_categorie()+"' WHERE codmenu="+m.getCodmenu();
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Menu updated !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
        @Override
    public List<Menu> getAll() {
        List<Menu> list = new ArrayList<>();
        try {
            String req = "Select `codmenu`,  `lib_plat`, `prix_plat`, `refer_resto`, `nom_plat`, `categorie_id` from menu";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while(rs.next()){
                Menu m = new Menu(((int)Float.parseFloat(rs.getString("codmenu"))),rs.getString("lib_plat"),((int)Float.parseFloat(rs.getString("prix_plat"))),rs.getString("refer_resto"),rs.getString("nom_plat"),rs.getString("categorie_id"));
                list.add(m);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
    
}
