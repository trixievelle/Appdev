<script>

const createBP = () => {
 
    let createBPdetails ={

        ST_ID:  ui("STUDENT_ID").getValue().trim(),
        ST_FN:  ui("FIRST_NAME").getValue().trim(),
        ST_LN:  ui("LAST_NAME").getValue().trim(),
        ST_DOB: ui("DATE_OF_BIRTH").getValue().trim(),
        ST_G:   ui("GENDER").getValue().trim(),
        ST_CI:  ui("CONTACT_INFO").getValue().trim(),
        ST_EC:  ui("EM_CONT").getValue().trim(),
        ST_N :  ui("NATIONALITY").getValue().trim(),
        ST_E :  ui("ETHNICITY").getValue().trim(),
        ST_ES:  ui("ENROLL_STAT").getValue().trim(),
        ST_AR:  ui("ATT_REC").getValue().trim(),
        ST_ACR: ui("ACAD_REC").getValue().trim(),
        ST_PS:  ui("PROG_STUD").getValue().trim(),
        ST_FA:  ui("FINAN_AID").getValue().trim(),
        ST_GD:  ui("GRAD_DATE").getValue().trim(),

    };

    ui("STUDENT_ID").setValue(createBPdetails.ST_ID).setEditable(false);
    ui("FIRST_NAME").setValue(createBPdetails.ST_FN).setEditable(false);
    ui("LAST_NAME").setValue(createBPdetails.ST_LN).setEditable(false);
    ui("DATE_OF_BIRTH").setValue(createBPdetails.ST_DOB).setEditable(false);
    ui("GENDER").setValue(createBPdetails.ST_G).setEditable(false);
    ui("CONTACT_INFO").setValue(createBPdetails.ST_CI).setEditable(false);
    ui("EM_CONT").setValue(createBPdetails.ST_EC).setEditable(false);
    ui("NATIONALITY").setValue(createBPdetails.ST_N).setEditable(false);
    ui("ETHNICITY").setValue(createBPdetails.ST_E).setEditable(false);
    ui("ENROLL_STAT").setValue(createBPdetails.ST_ES).setEditable(false);
    ui("ATT_REC").setValue(createBPdetails.ST_AR).setEditable(false);
    ui("ACAD_REC").setValue(createBPdetails.ST_ACR).setEditable(false);
    ui("PROG_STUD").setValue(createBPdetails.ST_PS).setEditable(false);
    ui("FINAN_AID").setValue(createBPdetails.ST_FA).setEditable(false);
    ui("GRAD_DATE").setValue(createBPdetails.ST_GD).setEditable(false);


};



</script>