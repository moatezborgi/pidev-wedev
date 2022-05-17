/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entity.Menu;
import com.mycompany.myapp.utilis.Static;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

/**
 *
 * @author Rania
 */
public class Servicemenu {
     public ArrayList<Menu> menu;

    public static Servicemenu instance = null;
    public boolean resultOK;
    private ConnectionRequest req;

    public Servicemenu() {
        req = new ConnectionRequest();
    }

    public static Servicemenu getInstance() {
        if (instance == null) {
            instance = new Servicemenu();
        }
        return instance;
    }
       public boolean addmenu(Menu t, String id) {
        System.out.println(t);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/addMenuJSON/new/"+id;
    
       req.setUrl(url);
       req.setPost(false);
       req.addArgument("lib_plat", t.getLib_plat());
       req.addArgument("prix_plat", t.getPrix_plat()+"");
       req.addArgument("nom_plat", t.getNom_plat());
       
  
       
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
    public ArrayList<Menu> parsemenu(String jsonText){
        try {
            menu =new ArrayList<>();
            JSONParser j = new JSONParser();
            Map<String,Object> menuListJson = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
            
            List<Map<String,Object>> list = (List<Map<String,Object>>)menuListJson.get("root");
            
            for(Map<String,Object> obj : list){
                
                Menu m = new Menu();
                  m.setCodemenu(((int)Float.parseFloat(obj.get("codmenu").toString())));
                  m.setLib_plat(obj.get("libPlat").toString());
                  m.setPrix_plat(((int)Float.parseFloat(obj.get("prixPlat").toString())));
                  m.setNom_plat(obj.get("NomPlat").toString());
                  
                menu.add(m);
 
            }
            
            
        } catch (IOException ex) {
            
        }
        return menu;
    }
    
    
     

    public ArrayList<Menu> getAllmenu(String id) {
        req = new ConnectionRequest();
         String url = Static.BASE_URL + "mobile/afficher_mobile_menu/"+id;
         req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
                        @Override

            public void actionPerformed(NetworkEvent evt) {
                                 menu = parsemenu(new String(req.getResponseData()));

                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
 
        return menu;
    }
 
       public void Deletemenu(int codemenu){
       ConnectionRequest con = new ConnectionRequest();
       String url = Static.BASE_URL+"mobile/deletemenu/"+codemenu;
       con.setUrl(url);
       con.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                con.removeResponseListener(this);
            }
       });
       NetworkManager.getInstance().addToQueueAndWait(con);
   }
        public boolean modifemenu(Menu t,String referresto) {
        System.out.println(t);
        System.out.println("********");
       //String url = Statics.BASE_URL + "create?name=" + t.getName() + "&status=" + t.getStatus();
       String url = Static.BASE_URL + "mobile/update_menu/"+t.getCodemenu();
    
       req.setUrl(url);
       req.setPost(false);
              req.addArgument("referresto", referresto);

       req.addArgument("lib_plat", t.getLib_plat());
       req.addArgument("prix_plat", t.getPrix_plat()+"");
       req.addArgument("nom_plat", t.getNom_plat());
      

       
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
