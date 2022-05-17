/*
 * Copyright (c) 2016, Codename One
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated 
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation 
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, 
 * and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions 
 * of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, 
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT 
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF 
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE 
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
 */
package com.mycompany.myapp.gui;

import com.codename1.components.FloatingActionButton;
import com.codename1.components.MultiButton;
import com.codename1.ui.Button;
import com.codename1.ui.ComboBox;
import com.codename1.ui.Command;
import com.codename1.ui.Component;
import static com.codename1.ui.Component.BOTTOM;
import static com.codename1.ui.Component.CENTER;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.Display;
import com.codename1.ui.FontImage;
import com.codename1.ui.Graphics;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.TextArea;
import com.codename1.ui.TextField;
import com.codename1.ui.Toolbar;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.layouts.FlowLayout;
import com.codename1.ui.layouts.GridLayout;
import com.codename1.ui.layouts.LayeredLayout;
import com.codename1.ui.plaf.Style;
import com.codename1.ui.util.Resources;
import com.mycompany.myapp.entities.Reclamation;
import com.mycompany.myapp.services.ServiceTypeReclamation;
import com.mycompany.myapp.entities.TypeReclamation;
import com.mycompany.myapp.services.ServiceReclamation;
import java.util.ArrayList;
import java.util.Vector;

/**
 * Represents a user profile in the app, the first form we open after the
 * 
 *
 * @author Shai Almog
 */
public class UpdateReclamation extends SideMenuBaseForm {

    public UpdateReclamation(Resources res, float id,String description,float count,String remboursement,float type_reclamation_id) {
        super(BoxLayout.y());
        Toolbar tb = getToolbar();
        tb.setTitleCentered(false);
       
      
        Button menuButton = new Button("");
        menuButton.setUIID("Title");
        FontImage.setMaterialIcon(menuButton, FontImage.MATERIAL_MENU);
        menuButton.addActionListener(e -> getToolbar().openSideMenu());

     
       
        
        

        

        FontImage arrowDown = FontImage.createMaterial(FontImage.MATERIAL_KEYBOARD_ARROW_DOWN, "Label", 3);
        ArrayList<TypeReclamation> en = ServiceTypeReclamation.getInstance().getAllTypeReclamations();

        Button btnValider = new Button("Valider");
//Label pp= new Label(ServiceUser.UriImage(SessionManager.getPhoto()),"PictureWhiteBackground");
        add(LayeredLayout.encloseIn( BorderLayout.south(GridLayout.encloseIn(3, FlowLayout.encloseCenter()))));

     
    
          TextField descriptions = new TextField(description);
        descriptions.setUIID("TextFieldBlack");
        addStringValue("descriptions : ", descriptions);

          TextField remboursementt = new TextField(remboursement);
        remboursementt.setUIID("TextFieldBlack");
        addStringValue("remboursement : ", remboursementt);
  
   String s = Float.toString(count);
        TextField prixx = new TextField(s, "tel", 20, TextArea.NUMERIC);
        prixx.setUIID("TextFieldBlack");
        addStringValue("tel", prixx);

   String sa = Float.toString(type_reclamation_id);
        TextField prixxx = new TextField(sa, "type_reclamation_id", 20, TextArea.NUMERIC);
        prixxx.setUIID("TextFieldBlack");
        addStringValue("type_reclamation_id", prixxx);
           
        btnValider.setUIID("Valider");
        addStringValue("", btnValider);
         Button del = new Button("Delete");
         addStringValue("", del);
        TextField path = new TextField("");
 btnValider.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent evt) {
                if ((descriptions.getText().length() == 0)   ) {
                    Dialog.show("Alert", "Please fill all the fields", new Command("OK"));
                } else {
                    try {
                                           float quanti = Float.parseFloat(prixx.getText());
                                           float quantia = Float.parseFloat(prixxx.getText());

                        Reclamation t = new Reclamation(id,quantia,descriptions.getText(),quanti,remboursementt.getText());
                        if (ServiceReclamation.getInstance().updateReclamation(t)) {
                            Dialog.show("Success", "Connection accepted", new Command("OK"));
                           new TypeReclamationForm(res).show();
                            refreshTheme();

                        } else {
                            Dialog.show("ERROR", "Server error", new Command("OK"));
                        }
                    } catch (NumberFormatException e) {
                        Dialog.show("ERROR", "saisie invalide", new Command("OK"));
                    }

                }

            }

        });
 del.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                ServiceReclamation.getInstance().deletReclamation(id);
              
                new ReclamationForm(res).show();
                refreshTheme();

            }
        });
    }

   

    private Image createCircleLine(int color, int height, boolean first) {
        Image img = Image.createImage(height, height, 0);
        Graphics g = img.getGraphics();
        g.setAntiAliased(true);
        g.setColor(0xcccccc);
        int y = 0;
        if (first) {
            y = height / 6 + 1;
        }
        g.drawLine(height / 2, y, height / 2, height);
        g.drawLine(height / 2 - 1, y, height / 2 - 1, height);
        g.setColor(color);
        g.fillArc(height / 2 - height / 4, height / 6, height / 2, height / 2, 0, 360);
        return img;
    }
private void addStringValue(String s, Component v) {
        add(BorderLayout.west(new Label(s, "PaddedLabel")).
                add(BorderLayout.CENTER, v));
      
    }
    @Override
    protected void showOtherForm(Resources res) {
        new StatsForm(res).show();
    }
}
