var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {




    (function ($, DataTable) {
 
if ( ! DataTable.ext.editorFields ) {
    DataTable.ext.editorFields = {};
}
 
var Editor = DataTable.Editor;
var _fieldTypes = DataTable.ext.editorFields;
 
 
function _triggerChange ( input ) {
  setTimeout( function () {
    input.trigger( 'change', {editor: true, editorSet: true} ); // editorSet legacy
  }, 0 );
}
 
_fieldTypes.radiobutton =  {
 
  // Locally "private" function that can be reused for the create and update methods
  _addOptions: function ( conf, opts ) {
    var val, label;
    var elOpts = conf._input[0].options;
    var jqInput = conf._input.empty();
 
    if ( opts ) {
      Editor.pairs( opts, conf.optionsPair, function ( val, label, i ) {
 
        jqInput.append(
          '<label for="'+Editor.safeId( conf.id )+'_'+i+'">'+
          '<input id="'+Editor.safeId( conf.id )+'_'+i+'" type="radio" name="'+conf.name+'" />'+
          label+'</label>'
        );
 
        /*jqInput.append(
          '<div>'+
            '<label for="'+Editor.safeId( conf.id )+'_'+i+'">'+
            '<input id="'+Editor.safeId( conf.id )+'_'+i+'" type="radio" name="'+conf.name+'" />'+
            label+'</label>'+
          '</div>'
        );*/
 
 
        $('input:last', jqInput).attr('value', val)[0]._editor_val = val;
      } );
    }
  },
 
 
  create: function ( conf ) {
    conf._input = $('<div />');
    _fieldTypes.radiobutton._addOptions( conf, conf.options || conf.ipOpts );
 
    this.on('open', function () {
      conf._input.find('input').each( function () {
        if ( this._preChecked ) {
          this.checked = true;
        }
      } );
    } );
 
    return conf._input[0];
  },
 
  get: function ( conf ) {
    var el = conf._input.find('input:checked');
    return el.length ? el[0]._editor_val : undefined;
  },
 
  set: function ( conf, val ) {
    var that  = this;
 
    conf._input.find('input').each( function () {
      this._preChecked = false;
 
      if ( this._editor_val == val ) {
        this.checked = true;
        this._preChecked = true;
      }
      else {
        // In a detached DOM tree, there is no relationship between the
        // input elements, so we need to uncheck any element that does
        // not match the value
        this.checked = false;
        this._preChecked = false;
      }
    } );
 
    _triggerChange( conf._input.find('input:checked') );
 
  },
 
  enable: function ( conf ) {
    conf._input.find('input').prop('disabled', false);
  },
 
  disable: function ( conf ) {
    conf._input.find('input').prop('disabled', true);
  },
 
  update: function ( conf, options ) {
    var radio = _fieldTypes.radiobutton;
    var currVal = radio.get( conf );
 
    radio._addOptions( conf, options );
 
    // Select the current value if it exists in the new data set, otherwise
    // select the first radio input so there is always a value selected
    var inputs = conf._input.find('input');
    radio.set( conf, inputs.filter('[value="'+currVal+'"]').length ?
      currVal :
      inputs.eq(0).attr('value')
    );
  }
 
};
 
 
})(jQuery, jQuery.fn.dataTable);



     $.extend( true, $.fn.dataTable.Editor.defaults, {
            formOptions: {
                main: {
                    onBackground: 'none'
                },
                bubble: {
                    onBackground: 'none'
                }
            }

        });
   

  $.extend( $.fn.dataTable.Editor.display.lightbox.conf, {
    offsetAni:     100,
    windowPadding: 100

} );

    editor = new $.fn.dataTable.Editor( {
        ajax : {
        url     : "/memberRegister",
        contentType: "application/json; charset=utf-8", 
        type: "GET" 
    },

      

 
        table: "#example",
        fields: [ {
                label: "First name:",
                name: "first_name"
            }, {
                label: "Middle name:",
                name: "middle_name"
            }, {
                label: "Last Name:",
                name: "last_name"
            },
              
               {
                label: "Registration No:",
                name: "registration_no"
            }, 

            {
                label: "Gender:",
                name: "gender",
                type: "radiobutton",
                options: [  
                "Male",
                "Female"
                ]
                },
 
             {
                label:"Birth Date",
                name:"birth_date",
                type:"datetime"
             },
            
              {
                label:"Marital status",
                name:"marital_status",
                type: "radiobutton",
                options: [  
                "Single",
                "Married"
                ]
             },

               {
                label:"Couple Full Names",
                name:"couple_names"
             },
  
            {
                label: "Phone:",
                name: "phone"
            }, 

            {
                label: "Email:",
                name: "email"
            },


              {
                label: "P.O.BOX:",
                name: "box_number"
            },


              {
                label: "Street Name:",
                name: "street_name"
            },


              {
                label: "House No:",
                name: "house_no"
            },

            {  label:"Bank Name",
               name:"bank_name"
            },

             {
            	label:"Account Number:",
            	name:"account_number"
            }, 
            {
                label:"Next kin Name",
                name:"nextkin_name"
            },{ label:"Next kin Relationship",
                 name:"nextkin_relationship"
            },
            {
                label: "joining date:",
                name: "joining_date",
                type:"datetime"
               
            }
        ]


    } );



         editor.on( 'preSubmit', function ( e, o, action ) {
        if ( action !== 'remove' ) {
            var firstName = this.field( 'first_name' );
 
            // Only validate user input values - different values indicate that
            // the end user has not entered a value
            if ( ! firstName.isMultiValue() ) {
                if ( ! firstName.val() ) {
                    firstName.error( 'A first name must be given' );
                }
                 
                if ( firstName.val().length >= 20 ) {
                    firstName.error( 'The first name length must be less that 20 characters' );
                }
            }
 
            // ... additional validation rules
 
            // If any error was reported, cancel the submission so it can be corrected
            if ( this.inError() ) {
                return false;
            }
        }
    } );
 

    $('#example').dataTable( {
        
            

        dom: "Bfrtip",

        ajax : {
        url:   "/memberRegister", 
        dataType: "json",
        contentType: "application/json; charset=utf-8", 
        type: "GET"
        }, 
  

        

        
        columns: [
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field


                name=data.first_name+' '+data.middle_name+' '+data.last_name;
                               return name
             
            },
                


        
               "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {

                name =oData.first_name+' '+oData.middle_name+' '+oData.last_name;

            $(nTd).html("<a href='/profile/"+oData.member_id+"/loanlist'>"+name+"</a>");
             }
          
             },



         
             {data: "registration_no"}, 
            {data:"gender"},
            {data:"birth_date",

               "render": function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
                 }
             }, 


            {data:"marital_status"},
             {data:"couple_names"},

            { data: "phone" },
             { data: "email" },
             {data:"box_number"},
             {data:"street_name"},
            
            { data: "bank_name" },
            { data: "account_number" },
             {data:"nextkin_name"},
             {data:"nextkin_relationship"},

            { data: "joining_date",

             "render": function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                return (month.length > 1 ? month : "0" + month) + "/" + date.getDate() + "/" + date.getFullYear();
                 }
           }
        ],
        select: true,
        severSide:true,

        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );

} );


 
       


  
 

  