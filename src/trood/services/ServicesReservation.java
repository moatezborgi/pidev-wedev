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
import trood.entity.Reservation;
import trood.utils.DataSource;
import java.text.DateFormat;

/**
 *
 * @author Rania
 */
public class ServicesReservation implements IService<Reservation> {
    Connection cnx = DataSource.getInstance().getCnx();
           @Override

    public void ajouter(Reservation re) {
        try {
            String req = "INSERT INTO `reservation`(`nom`, `prenom`, `date_reservation`, `time`, `nb_perso`, `telephone`, `refer_resto`) VALUES ('"+re.getNom()+"','"+re.getPrenom()+"','"+re.getDate_reservation()+"','"+re.getTime()+"','"+re.getNb_perso()+"','"+re.getTelephone()+"','"+re.getRefer_resto()+"')";
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Reservation created !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void supprimer(String id) {
        try {
            String req = "DELETE FROM `reservation` WHERE  id = " + id;
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("reservation deleted !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
      @Override
    public void modifier(Reservation re) {
        try {
           String req = " UPDATE `reservation` SET `nom`='" + re.getNom() + "',`prenom`='" + re.getPrenom() + "',`date_reservation`='" + re.getDate_reservation() + "',`time`='" + re.getTime() + "',`nb_perso`='" + re.getNb_perso() + "',`telephone`='" + re.getTelephone() + "',`refer_resto`='" + re.getRefer_resto() + "' WHERE id="+re.getId();
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("Menu updated !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
    
    
        @Override
    public List<Reservation> getAll() {
        DateFormat date_reservation=DateFormat.getDateInstance();
        List<Reservation> list = new ArrayList<>();
        try {
            String req = "SELECT `id`, `nom`, `prenom`, to_char(`date_reservation`,'yyy-mm-dd') as date_reservation , `time`, `nb_perso`, `telephone`, `refer_resto` from `reservation`";
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery(req);
            while(rs.next()){
                Reservation re =new Reservation(((int)Float.parseFloat(rs.getString("id"))),rs.getString("nom"),rs.getString("prenom"),rs.getString("date_reservation"),rs.getString("time"),((int)Float.parseFloat(rs.getString("nb_perso"))),rs.getString("telephone"),rs.getString("refer_resto"));
                
                list.add(re);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
    
    
}
