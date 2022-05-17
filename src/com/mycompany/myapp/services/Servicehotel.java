/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.services;
import com.mycompany.myapp.utilis.Static;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
 import com.codename1.ui.events.ActionListener;

import com.mycompany.myapp.entity.Hotel;
import java.util.List;


import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

/**
 *
 * @author MSI
 */
public class Servicehotel {
    public ArrayList<Hotel> hotels;

    public static Servicehotel instance = null;
    public boolean resultOK;
    private ConnectionRequest req;

    public Servicehotel() {
        req = new ConnectionRequest();
    }

    public static Servicehotel getInstance() {
        if (instance == null) {
            instance = new Servicehotel();
        }
        return instance;
    }
       public boolean addhotel(Hotel t) {
        System.out.println(t);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/addhotel";
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("id", t.getId());
       req.addArgument("nomHotel", t.getNom_hotel());
              req.addArgument("villeHotel", t.getVille_hotel());
         req.addArgument("nbetoile",t.getNb_etoile()+"");

       
       req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }
    public ArrayList<Hotel> parsehotel(String jsonText){
        try {
            hotels =new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> hotelListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)hotelListJson.get("root");
            
            for(Map<String,Object> obj : list){
                
                Hotel h = new Hotel();
                      h.setId(obj.get("id").toString());
                  h.setNom_hotel(obj.get("nomHotel").toString());
                  h.setVille_hotel(obj.get("villeHotel").toString());
                  h.setNb_etoile(((int)Float.parseFloat(obj.get("nbEtoile").toString())));
                hotels.add(h);
 
            }
            
            
        } catch (IOException ex) {
            
        }
        return hotels;
    }
    
    
     

    public ArrayList<Hotel> getAllhotels() {
        req = new ConnectionRequest();
         String url = Static.BASE_URL + "mobile/listhotel/";
         req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
                        @Override

            public void actionPerformed(NetworkEvent evt) {
                                 hotels = parsehotel(new String(req.getResponseData()));

                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
 
        return hotels;
    }
 
       public void DelPant(String id){
       ConnectionRequest con = new ConnectionRequest();
       String url = Static.BASE_URL+"mobile/delhotel/"+id;
       con.setUrl(url);
       con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                con.removeResponseListener(this);
            }
       });
       NetworkManager.getInstance().addToQueueAndWait(con);
   }
        public boolean modifehotel(Hotel t) {
        System.out.println(t);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/edit/"+t.getId();
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("id", t.getId());
       req.addArgument("nomHotel", t.getNom_hotel());
              req.addArgument("villeHotel", t.getVille_hotel());
         req.addArgument("nbetoile",t.getNb_etoile()+"");

       
       req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }
}
