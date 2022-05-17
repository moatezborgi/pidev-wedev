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

import com.mycompany.myapp.entity.Chambre;
import com.mycompany.myapp.entity.Hotel;
 import java.util.List;


import java.io.IOException;
import java.util.ArrayList;
import java.util.Map;

/**
 *
 * @author MSI
 */
public class Servicechambre {
     public ArrayList<Chambre> chambre;

    public static Servicechambre instance = null;
    public boolean resultOK;
    private ConnectionRequest req;

    public Servicechambre() {
        req = new ConnectionRequest();
    }

    public static Servicechambre getInstance() {
        if (instance == null) {
            instance = new Servicechambre();
        }
        return instance;
    }
    
       public boolean addchambre(Chambre ch) {
        System.out.println(ch);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/addchambre";
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("id", ch.getNum_chambre()+"");
       req.addArgument("type_chambre", ch.getType_chambre());
              req.addArgument("nb_lit", ch.getNb_lits()+"");
         req.addArgument("dispo",ch.getDispo());
                  req.addArgument("vue",ch.getVue());
                                    req.addArgument("referhotel",ch.getRefer_hotel());
                                                                        req.addArgument("prix",ch.getPrix()+"");




       
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
    
       
         public ArrayList<Chambre> parsehotel(String jsonText){
        try {
            chambre =new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> hotelListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)hotelListJson.get("root");
            
            for(Map<String,Object> obj : list){
                
                Chambre h = new Chambre();
                      h.setNum_chambre(((int)Float.parseFloat(obj.get("numChambre").toString())));
                  h.setType_chambre(obj.get("typeChambre").toString());
               h.setVue(obj.get("vueChambre").toString());
                  h.setNb_lits(((int)Float.parseFloat(obj.get("nbLit").toString())));
                          h.setRefer_hotel(obj.get("referHotel").toString());
                                                    h.setPrix(((int)Float.parseFloat(obj.get("prixNuit").toString())));
                          h.setRefer_hotel(obj.get("referHotel").toString());

                                  h.setDispo(obj.get("disponibilite").toString());


                 chambre.add(h);
 
            }
            
            
        } catch (IOException ex) {
            
        }
        return chambre;
    }
    
    
     

    public ArrayList<Chambre> getAllhotels(String id) {
        req = new ConnectionRequest();
         String url = Static.BASE_URL + "mobile/listechambre/"+id;
         System.out.println(url);
         
         req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
                        @Override

            public void actionPerformed(NetworkEvent evt) {
                                 chambre = parsehotel(new String(req.getResponseData()));

                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
 
        return chambre;
    }
 
       public void DelPant(int id){
       ConnectionRequest con = new ConnectionRequest();
       String url = Static.BASE_URL+"mobile/suppchambmobile/"+id;
       con.setUrl(url);
       con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                con.removeResponseListener(this);
            }
       });
       NetworkManager.getInstance().addToQueueAndWait(con);
   }
      public boolean modifchamb(Chambre ch) {
         System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/editchambr/"+ch.getNum_chambre();
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("id", ch.getNum_chambre()+"");
       req.addArgument("type_chambre", ch.getType_chambre());
              req.addArgument("nb_lit", ch.getNb_lits()+"");
         req.addArgument("dispo",ch.getDispo());
                  req.addArgument("vue",ch.getVue());
                                    req.addArgument("referhotel",ch.getRefer_hotel());
                                                                        req.addArgument("prix",ch.getPrix()+"");

       
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
