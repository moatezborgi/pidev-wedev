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
import com.mycompany.myapp.entity.Menu;
import com.mycompany.myapp.services.Servicemenu;

/**
 *
 * @author Rania
 */
public class listemenu extends SideMenuBaseForm{
       public listemenu(Resources res, String id) {
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
         Servicemenu ME = new Servicemenu();
        for(Menu eee :  ME.getAllmenu(id)) {
               addButton(eee,res,id);

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
    
     private void addButton(Menu me ,Resources res, String id) {
     int height = Display.getInstance().convertToPixels(11.5f);
       int width = Display.getInstance().convertToPixels(1f);
            Container cnt1 = new Container(); 

              Label codemenu=new Label(me.getCodemenu()+"");
              Label lib_plat= new Label(me.getLib_plat());
              Label prix_plat=    new Label(me.getLib_plat());
              Label nom_plat=    new Label(me.getNom_plat());
          // TextArea ta = new TextArea(o.getNom_hotel());
             // TextArea id = new TextArea(o.getId());
              //TextArea ville = new TextArea(o.getVille_hotel());
                //TextArea nb = new TextArea(o.getNb_etoile()+"");
               Button supp = new Button();
               Button modif=new Button();
               Button menu =new Button("Affecter menu");
                  Style a = new Style(supp.getUnselectedStyle());
        
         //s.setFgColor(0xa65959);
       FontImage ajouterP =FontImage.createMaterial(FontImage.MATERIAL_DELETE, a);
              FontImage modifp =FontImage.createMaterial(FontImage.MATERIAL_EDIT, a);

         supp.setIcon(ajouterP);
         modif.setIcon(modifp);
                  modif.setTextPosition(RIGHT);

         supp.setTextPosition(RIGHT);
         cnt1.add(codemenu);
         cnt1.add(lib_plat);
         cnt1.add(prix_plat);
         cnt1.add(nom_plat);
         cnt1.add(supp);
            cnt1.add(modif);

          add(cnt1);
 
       supp.addActionListener( e -> {
    
         
             InfiniteProgress ip = new InfiniteProgress();
             final Dialog iDialog = ip.showInfiniteBlocking();
             
             
                           Servicemenu.getInstance().Deletemenu(me.getCodemenu());

             iDialog.dispose();
              new listemenu(res,id).show();
             refreshTheme();
             Dialog.show("Supprimé","menu supprimé avec succès!",new Command("OK"));
 
         
      });
       
        modif.addActionListener( e -> {
    
          
              new modifmenu(res,me,id).show();
   
            
      });
         // menu.addActionListener( e -> {
     
              //new addchambre(res,o.getId()).show();
   
      //});
       
       
}
    
}
