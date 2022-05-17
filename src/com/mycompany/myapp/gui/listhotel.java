/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.SpanLabel;
import static com.codename1.push.PushContent.setTitle;
import com.mycompany.myapp.services.Servicehotel;
import com.codename1.components.SpanLabel;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;

/**
 *
 * @author MSI
 */
public class listhotel extends Form {
       public listhotel(Form previous) {
         
 
 
    
 
    
     
       setTitle("List hotel");

        SpanLabel sp = new SpanLabel();
        sp.setText(Servicehotel.getInstance().getAllhotels().toString());
        
      
      add(sp);
              getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());

    }
    
}
