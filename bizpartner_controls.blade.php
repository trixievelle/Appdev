<script>
    
    function CreateContent(){

        var go_Shell = new sap.m.Shell({});
        //left page
        go_App_Left = new sap.m.App({});
        go_App_Left.addPage(create_page_menu());

        //right page
        go_App_Right = new sap.m.App({});
        go_App_Right.addPage(createBizPage());	

        go_SplitContainer = new sap.ui.unified.SplitContainer({ content: [go_App_Right], secondaryContent: [go_App_Left]});		
        go_SplitContainer.setSecondaryContentWidth("250px");
        go_SplitContainer.setShowSecondaryContent(true);
        

        let go_App = new sap.m.App({
            pages : [go_SplitContainer]
        });

        go_Shell.setApp(go_App);
        go_Shell.setAppWidthLimited(false);
        go_Shell.placeAt("content");     
    }

    function create_page_menu(){
        let page = new sap.m.Page({}).addStyleClass('sapUiSizeCompact');
        let pageHeader  = new sap.m.Bar({enableFlexBox: false,contentMiddle:[ new sap.m.Label({text:"Action"})]});
        const menuList = new sap.m.List("MENU_LIST",{});
		const menuListTemplate = new sap.m.StandardListItem("LEFT_MENU_TEMPLATE",{
			title:"{title}",
			icon:"{icon}",
			visible:"{visible}",
			type: sap.m.ListType.Active,
			press:function(oEvent){
				
                alert(oEvent.getSource().getBindingContext().getProperty('title'));
                go_App_Right.to('CREATE_BP_PAGE');
			}
		});
		
        const gt_list = [
                {
                    title   : "Create Student Info",
                    icon    : "sap-icon://add-product",
                    visible : true
                },
                {
                    title   : "Display Student Info",
                    icon    : "sap-icon://business-card",
                    visible : true
                },
                {
                    title   : "Student Info Listing",
                    icon    : "sap-icon://checklist-item",
                    visible : true
                }

        ];

        let model = new sap.ui.model.json.JSONModel();
			model.setSizeLimit(gt_list.length);
			model.setData(gt_list);

			ui('MENU_LIST').setModel(model).bindAggregation("items",{
				path:"/",
				template:ui('LEFT_MENU_TEMPLATE')
			});
		
        page.setCustomHeader(pageHeader);
		page.addContent(menuList);		
		return page;
    }

    function createBizPage(){
        let page  = new sap.m.Page("CREATE_BP_PAGE",{}).addStyleClass('sapUiSizeCompact');
        let pageHeader = new sap.m.Bar("",{  
			enableFlexBox: false,
			contentLeft:[
				new sap.m.Button({ icon:"sap-icon://nav-back",
					press:function(oEvt){
						
					} 
				}),
				new sap.m.Button({icon:"sap-icon://menu2",
					press:function(){
						go_SplitContainer.setSecondaryContentWidth("250px");
						if(!go_SplitContainer.getShowSecondaryContent()){
							go_SplitContainer.setShowSecondaryContent(true);
						} else {							
							go_SplitContainer.setShowSecondaryContent(false);
						}
					
					}
				}), 
				
			],
			contentMiddle:[
                new sap.m.Label("",{text:"Create Student Info"})
            ],
		
		});
        let crumbs = new sap.m.Breadcrumbs("CREATE_BP_BRDCRMS",{
            currentLocationText: "Create Student Info",
            links: [
                new sap.m.Link({
                    text:"Home",
                    press:function(oEvt){
                       // fn_click_breadcrumbs("HOME");
                    }
                }),
				new sap.m.Link("CREATE_BP_BRDCRMS_TITLE",{
                    text:"Student Info Management",
                    press:function(oEvt){
                      //  fn_click_breadcrumbs("HOME");
                    }
                }),
				
            ]
        });

        let createPageForm = new sap.uxap.ObjectPageLayout({
            headerTitle:[
                new sap.uxap.ObjectPageHeader("OBJECTHEADER_BP_NAME",{
                    objectTitle:"",
					showPlaceholder : false,
					actions:[
                        new sap.uxap.ObjectPageHeaderActionButton("CREATE_BP_SAVE_BTN",{
                            icon: "sap-icon://save",
							press: function(){

								createBP();

                            }
                        }).addStyleClass("sapMTB-Transparent-CTX"),
                        new sap.uxap.ObjectPageHeaderActionButton("CREATE_BP_EDIT_BTN",{
                            icon: "sap-icon://edit",
							press: function(){

                            }
                        }).addStyleClass("sapMTB-Transparent-CTX"),

                    ],
                })
            ],
            sections:[
                new sap.uxap.ObjectPageSection("GENERAL_DATA_TAB",{
                    title: "Student Info",
                    subSections : [
                        new sap.uxap.ObjectPageSubSection({
                            title: "",
							blocks:[
                                new sap.m.Panel({
                                    content: [
                                        new sap.ui.layout.Grid({
                                            defaultSpan:"L12 M12 S12",
											width:"auto",
											content:[
                                                new sap.ui.layout.form.SimpleForm({
                                                    maxContainerCols:2,
													labelMinWidth:130,
													content:[
                                                        new sap.ui.core.Title("GENERAL_INFO_TITLE1",{text:""}),

                                                        new sap.m.Label({text:"Student ID Number",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("STUDENT_ID",{value:"", width:TextWidth}),

                                                        new sap.m.Label({text:"First Name",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("FIRST_NAME",{value:"", width:TextWidth}),
                                                        
                                                        new sap.m.Label({text:"Last Name",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("LAST_NAME",{
															value:"", 
															width:TextWidth,
                                                            editable: true,
															liveChange : function(oEvt){
																var lv_value = oEvt.getSource().getValue().trim();
																/* 
																if(gv_partner_ind){
																	var lv_obj_header = ""
																	var label = "New Business Partner"
																	lv_obj_header = label + " (" + lv_value + ")";
																	ui("OBJECTHEADER_BP_NAME").setObjectTitle(lv_obj_header).setObjectSubtitle("");
																}
																*/
															}
														}),
														
														new sap.m.Label({text:"Date of Birth",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("DATE_OF_BIRTH",{width:TextWidth}),

														new sap.m.Label({text:"Gender",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("GENDER",{value:"", width:TextWidth}),
														
														new sap.m.Label({text:"Contact Information",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("CONTACT_INFO",{width:TextWidth}),

														new sap.m.Label({text:"Emergency Contact Information",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("EM_CONT",{width:TextWidth}),

														new sap.m.Label({text:"Nationality",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("NATIONALITY",{width:TextWidth}),




                                                        new sap.ui.core.Title("STUDENT_INFO",{text:""}),

														new sap.m.Label({text:"Ethnicity",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("ETHNICITY",{width:TextWidth}),

														new sap.m.Label({text:"Enrollment Status",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("ENROLL_STAT",{width:TextWidth}),

														new sap.m.Label({text:"Attendance Record",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("ATT_REC",{width:TextWidth}),

														new sap.m.Label({text:"Academic Record",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("ACAD_REC",{width:TextWidth}),

														new sap.m.Label({text:"Program of Study",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("PROG_STUD",{width:TextWidth}),

														new sap.m.Label({text:"Financial Aid Information",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("FINAN_AID",{width:TextWidth}),

														new sap.m.Label({text:"Graduate Date",width:labelWidth}).addStyleClass('class_label_padding'),
														new sap.m.Input("GRAD_DATE",{width:TextWidth}),



                                                    ]
                                                })
                                            ]
                                        })
                                    ]
                                })
                            ]
                        }),
                        new sap.uxap.ObjectPageSubSection({
                            title: "ADDRESS",
                            blocks:[]
                        })
                    ]        
                }),
                /*new sap.uxap.ObjectPageSection("COMP_CODE_TAB",{
					title: "Company Code",
					subSections:[
						new sap.uxap.ObjectPageSubSection({
							blocks:[
								new sap.m.Panel({
									content:[
										new sap.ui.table.Table("GO_TABLE_COMPCODE",{
											visibleRowCount:8,
											selectionMode:"None",
											enableCellFilter: true,
											enableColumnReordering:true,
											toolbar:[
												new sap.m.Toolbar({
													design:"Transparent",
													content:[
														new sap.m.Text("TABLE_LABEL_COMPCODE",{text:"Company Code (0)"}),
														new sap.m.ToolbarSpacer(),
														new sap.m.Button ("COMPCODE_ADD_BUTTON",{
															icon: "sap-icon://add",
															press: function(){
																gv_bind_mode = "create";
																ui('COMPCODE_FORM_DIALOG').open();
															}
														})
													]
												})
											],
											columns:[
												
												new sap.ui.table.Column({label:new sap.m.Text({text:"Company Code"}),
													autoResizable:true,
													sortProperty:"COMPANY_DESC",
													filterProperty:"COMPANY_DESC",
													autoResizable:true,
													template:new sap.m.Text({text:"{COMPANY_DESC}",maxLines:1,tooltip:"{COMPANY_DESC}"})
												}),
												new sap.ui.table.Column({label:new sap.m.Text({text:"Business Reg No"}),
													autoResizable:true,
													sortProperty:"BIZ_REG",
													filterProperty:"BIZ_REG",
													autoResizable:true,
													template:new sap.m.Text({text:"{BIZ_REG}",maxLines:1,tooltip:"{BIZ_REG}"})
												}),
												new sap.ui.table.Column({label:new sap.m.Text({text:"Payment Term"}),
													autoResizable:true,
													sortProperty:"PYMT_TERM",
													filterProperty:"PYMT_TERM",
													autoResizable:true,
													template:new sap.m.Text({text:"{PYMT_TERM}",maxLines:1,tooltip:"{PYMT_TERM}"})
												}),
												new sap.ui.table.Column({label:new sap.m.Text({text:"GST Reg No"}),
													autoResizable:true,
													sortProperty:"GST_REG",
													filterProperty:"GST_REG",
													autoResizable:true,
													template:new sap.m.Text({text:"{GST_REG}",maxLines:1,tooltip:"{GST_REG}"})
												}),
												new sap.ui.table.Column({label:new sap.m.Text({text:"GST Effective Date"}),
													autoResizable:true,
													sortProperty:"GST_DATE",
													filterProperty:"GST_DATE_DESC",
													autoResizable:true,
													template:new sap.m.Text({text:"{GST_DATE_DESC}",maxLines:1,tooltip:"{GST_DATE_DESC}"})
												}),
												new sap.ui.table.Column("COMPCODE_DEL_BTN", {
													width:"50px",
													hAlign :"Left",
													template: new sap.m.Button({
														icon: "sap-icon://delete",
														width: "100%",
														textAlign: "Left",
														press: function (oEvt) {
															var lo_index = String(oEvt.getSource().getBindingContext().getPath());
															var lv_index = parseInt(lo_index.split("/")[1]);
															var lt_deleted_data = gt_compcode_details.splice(lv_index,1);
																							
															for(var i=0; i < lt_deleted_data.length; i++){
																if(lt_deleted_data[i].DATA_ID !== ""){
																	gt_deleted_compcode_data.push(lt_deleted_data[i]);
																}
															}
															fn_bind_bizdata(gt_compcode_details,"GO_TABLE_COMPCODE");
															ui('TABLE_LABEL_COMPCODE').setText("Company Code ("+gt_compcode_details.length+")");
														}
													})
												}),
												
											],
											cellClick : function(oEvt){
												var lv_bind = oEvt.getParameters().rowBindingContext;	
												if(lv_bind != undefined){
													gv_bind_mode = "edit";
													var lv_data = ui("GO_TABLE_COMPCODE").getModel().getData();
													var lv_row_index = oEvt.getParameters().rowIndex;
													gv_bind_index = fn_actual_index("GO_TABLE_COMPCODE",lv_row_index);
													fn_set_company_code_fields_visibility(lv_bind);
												}
											}
										})
									]
								})
							]
						})
					]
				}),
                */new sap.uxap.ObjectPageSection("SECTION_ATTACHMENT",{
                    title:"ATTACHMENT",
					subSections:[
						new sap.uxap.ObjectPageSubSection({
                            title:"Attachment",
							blocks:[
							]
						})
					]
				}),
            ]      
        });

        page.setCustomHeader(pageHeader);
        page.addContent(crumbs);
        page.addContent(createPageForm);
        return page;
    }



</script>