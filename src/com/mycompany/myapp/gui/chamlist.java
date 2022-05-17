/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.FloatingActionButton;
import com.codename1.components.InfiniteProgress;
import com.codename1.components.MultiButton;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import static com.codename1.ui.Component.RIGHT;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.Toolbar;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.util.Resources;
import com.mycompany.myapp.entity.Hotel;
import com.mycompany.myapp.entity.Chambre;

import com.mycompany.myapp.services.Servicehotel;
import com.mycompany.myapp.services.Servicechambre;


/**
 *
 * @author MSI
 */
public class chamlist extends SideMenuBaseForm {
       public chamlist(Resources res,String id) {
        super(BoxLayout.y());
        Toolbar tb = getToolbar();
        tb.setTitleCentered(false);
        Image profilePic = res.getImage("user-picture.jpg");
        Image mask = res.getImage("round-mask.png");
        profilePic = profilePic.fill(mask.getWidth(), mask.getHeight());
        Label profilePicLabel = new Label(profilePic, "ProfilePicTitle");
        profilePicLabel.setMask(mask.createMask());

        Button menuButton = new Button("");
        menuButton.setUIID("Title");
        FontImage.setMaterialIcon(menuButton, FontImage.MATERIAL_MENU);
        menuButton.addActionListener(e -> getToolbar().openSideMenu());
        
        Container remainingTasks = BoxLayout.encloseY(
                        new Label("12", "CenterTitle"),
                        new Label("remaining tasks", "CenterSubTitle")
                );
        remainingTasks.setUIID("RemainingTasks");
        Container completedTasks = BoxLayout.encloseY(
                        new Label("32", "CenterTitle"),
                        new Label("completed tasks", "CenterSubTitle")
        );
        completedTasks.setUIID("CompletedTasks");

        Container titleCmp = BoxLayout.encloseY(
                        FlowLayout.encloseIn(menuButton),
                        BorderLayout.centerAbsolute(
                                BoxLayout.encloseY(
                                    new Label("Jennifer Wilson", "Title"),
                                    new Label("UI/UX Designer", "SubTitle")
                                )
                            ).add(BorderLayout.WEST, profilePicLabel),
                        GridLayout.encloseIn(2, remainingTasks, completedTasks)
                );
        
        FloatingActionButton fab = FloatingActionButton.createFAB(FontImage.MATERIAL_ADD);
        fab.getAllStyles().setMarginUnit(Style.UNIT_TYPE_PIXELS);
        fab.getAllStyles().setMargin(BOTTOM, completedTasks.getPreferredH() - fab.getPreferredH() / 2);
        tb.setTitleComponent(fab.bindFabToContainer(titleCmp, CENTER, BOTTOM));
                        
      
        
        FontImage arrowDown = FontImage.createMaterial(FontImage.MATERIAL_KEYBOARD_ARROW_DOWN, "Label", 3);
         Servicechambre ME = new Servicechambre();
        for(Chambre eee : ME.getAllhotels(id)) {
               addButton(eee,res);

          /*  Container tl = TableLayout.encloseIn(5, new Label(eee.getId()),
                new Label(eee.getNom_hotel()),
                new Label(eee.getVille_hotel()),
                new Label(eee.getNb_etoile()+""),
                new Button("Supprimer"));
                add(tl);*/
       //  addButton(res.getImage("news-item-2.jpg"), "Fusce ornare cursus masspretium tortor integer placera.", true, 15, 21);
        //addButton(res.getImage("news-item-3.jpg"), "Maecenas eu risus blanscelerisque massa non amcorpe.", false, 36, 15);
       // addButton(res.getImage("news-item-4.jpg"), "Pellentesque non lorem diam. Proin at ex sollicia.", false, 11, 9);
    } 
  
        setupSideMenu(res);
    }
    
    private void addButtonBottom(Image arrowDown, String text, int color, boolean first) {
        MultiButton finishLandingPage = new MultiButton(text);
        finishLandingPage.setEmblem(arrowDown);
        finishLandingPage.setUIID("Container");
        finishLandingPage.setUIIDLine1("TodayEntry");
        finishLandingPage.setIcon(createCircleLine(color, finishLandingPage.getPreferredH(),  first));
        finishLandingPage.setIconUIID("Container");
        add(FlowLayout.encloseIn(finishLandingPage));
    }
    
    private Image createCircleLine(int color, int height, boolean first) {
        Image img = Image.createImage(height, height, 0);
        Graphics g = img.getGraphics();
        g.setAntiAliased(true);
        g.setColor(0xcccccc);
        int y = 0;
        if(first) {
            y = height / 6 + 1;
        }
        g.drawLine(height / 2, y, height / 2, height);
        g.drawLine(height / 2 - 1, y, height / 2 - 1, height);
        g.setColor(color);
        g.fillArc(height / 2 - height / 4, height / 6, height / 2, height / 2, 0, 360);
        return img;
    }

    @Override
    protected void showOtherForm(Resources res) {
        new StatsForm(res).show();
    }
    
     private void addButton(Chambre o,Resources res) {
     int height = Display.getInstance().convertToPixels(11.5f);
       int width = Display.getInstance().convertToPixels(1f);
            Container cnt1 = new Container(); 

Label numchambre=new Label(o.getNum_chambre()+"");
      Label type_chambre= new Label(o.getType_chambre());
              Label vue_chambre=    new Label(o.getVue());
               Label nblit=   new Label(o.getNb_lits()+"");
                     Label dispo=   new Label(o.getDispo()+"");

          // TextArea ta = new TextArea(o.getNom_hotel());
             // TextArea id = new TextArea(o.getId());
              //TextArea ville = new TextArea(o.getVille_hotel());
                //TextArea nb = new TextArea(o.getNb_etoile()+"");
               Button supp = new Button();
               Button modif=new Button();
                   Style a = new Style(supp.getUnselectedStyle());
        
         //s.setFgColor(0xa65959);
       FontImage ajouterP =FontImage.createMaterial(FontImage.MATERIAL_DELETE, a);
              FontImage modifp =FontImage.createMaterial(FontImage.MATERIAL_EDIT, a);

         supp.setIcon(ajouterP);
         modif.setIcon(modifp);
                  modif.setTextPosition(RIGHT);

         supp.setTextPosition(RIGHT);
         cnt1.add(numchambre);

         cnt1.add(type_chambre);
         cnt1.add(vue_chambre);
         cnt1.add(nblit);
                  cnt1.add(dispo);

         cnt1.add(supp);
             cnt1.add(modif);

          add(cnt1);
 
       supp.addActionListener( e -> {
    
         try{ 
             InfiniteProgress ip = new InfiniteProgress();
             final Dialog iDialog = ip.showInfiniteBlocking();
             
             
                           Servicechambre.getInstance().DelPant(o.getNum_chambre());

             iDialog.dispose();
              new listshotel(res).show();
             refreshTheme();
             Dialog.show("Supprimé","Chambre supprimé avec succès!",new Command("OK"));
 
          }catch(Exception ex){
             ex.printStackTrace();
         }  
      });
       
      modif.addActionListener( e -> {
    
          
              new modifchamb(res,o).show();
   
            
      });
        /*  chambre.addActionListener( e -> {
     
              new addchambre(res,o.getId()).show();
   
      }); */
       
       
}
    
}
