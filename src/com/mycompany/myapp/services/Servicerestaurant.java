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

import com.mycompany.myapp.entity.Restaurant;
import java.util.List;


import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

/**
 *
 * @author Rania
 */
public class Servicerestaurant {
    
    public ArrayList<Restaurant> resto;

    public static Servicerestaurant instance = null;
    public boolean resultOK;
    private ConnectionRequest req;

    public Servicerestaurant() {
        req = new ConnectionRequest();
    }

    public static Servicerestaurant getInstance() {
        if (instance == null) {
            instance = new Servicerestaurant();
        }
        return instance;
    }
       public boolean addresto(Restaurant t) {
        System.out.println(t);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/addRestaurantJSON/new";
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("referResto", t.getRefer_resto());
       req.addArgument("nomresto", t.getNom_resto());
       req.addArgument("tel", t.getTel());
       req.addArgument("adresseResto", t.getAdresse());
       req.addArgument("nbEtoile", t.getNb_etoile());
  
       
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
    public ArrayList<Restaurant> parseresto(String jsonText){
        try {
            resto =new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> restoListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)restoListJson.get("root");
            
            for(Map<String,Object> obj : list){
                
                Restaurant r = new Restaurant();
                  r.setRefer_resto(obj.get("referResto").toString());
                  r.setNom_resto(obj.get("nomResto").toString());
                  r.setTel(obj.get("tel").toString());
                  r.setAdresse(obj.get("adresseResto").toString());
                  r.setNb_etoile(obj.get("nbEtoile").toString());
                resto.add(r);
 
            }
            
            
        } catch (IOException ex) {
            
        }
        return resto;
    }
    
    
     

    public ArrayList<Restaurant> getAllresto() {
        req = new ConnectionRequest();
         String url = Static.BASE_URL + "mobile/afficher_mobile_resto";
         req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
                        @Override

            public void actionPerformed(NetworkEvent evt) {
                                 resto = parseresto(new String(req.getResponseData()));

                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
 
        return resto;
    }
 
       public void Deleteresto(String refer_resto){
       ConnectionRequest con = new ConnectionRequest();
       String url = Static.BASE_URL+"mobile/deleteresto/"+refer_resto;
       con.setUrl(url);
       con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                con.removeResponseListener(this);
            }
       });
       NetworkManager.getInstance().addToQueueAndWait(con);
   }
        public boolean modiferesto(Restaurant t) {
        System.out.println(t);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/update/"+t.getRefer_resto();
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("referResto", t.getRefer_resto());
       req.addArgument("nomresto", t.getNom_resto());
       req.addArgument("tel", t.getTel());
       req.addArgument("adresseResto", t.getAdresse());
       req.addArgument("nbEtoile", t.getNb_etoile());

       
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

