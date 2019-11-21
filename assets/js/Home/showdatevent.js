$(document).ready(function() {
  /* Datatable */
  $("#datatable").DataTable();

  /* Datepicker */
  let currentDate = new Date();
  $("#endDate").datepicker({
    dateFormat: "yy-mm-dd"
  });

  $("#startDate").datepicker({
    dateFormat: "yy-mm-dd"
  });
  $("#endDate").datepicker("setDate", currentDate);
  $("#startDate").datepicker("setDate", currentDate);


const noticeOnEventResults = (e) => {
        let message = e ? '<span uk-icon=\'icon: check\'></span> Event Succefully Added!' : '<span uk-icon=\'icon: warning\'></span> Fail to add event..!',
            status = e ? `success` : `danger`,
            position = 'top-center'
        UIkit.notification({
            message: message,
            status: status,
            pos: position
        })
    }






  listen("click", on("#submitevent"), () => {
    const subject = domValue(`#add-event-modal [name="subject"]`),
      location = domValue(`#add-event-modal [name="location"]`),
      startTime =
        domValue(`#add-event-modal [name="startDate"]`) +
        domValue(`#add-event-modal [name="startTime"]`),
      endTime =
        domValue(`#add-event-modal [name="endDate"]`) +
        domValue(`#add-event-modal [name="endTime"]`),
      summary = domValue(`#add-event-modal [name="textarea"]`),
      file = on(`#add-event-modal [name="files"]`).files[0],
      error = !subject ? true : !location ? true : !startTime ? true : !endTime ? true : !summary ? true : false 

     if(error){
         domStyle(`#add-event-modal .alert`,'display:block');
     }else {
        domStyle(`#add-event-modal .alert`,'display:none');
        var formdata = new FormData(),
            ajax
        formdata.append('fileId', file ? 'datevent_'+Date.now()+file.name.replace(/[^a-zA-Z.]/g, "") : 0)
        formdata.append('location',location)
        formdata.append('subject',subject)
        formdata.append('startTime',startTime)
        formdata.append('endTime',endTime)
        formdata.append('summary',summary)
        formdata.append('file',file)
        formdata.append('date',getDateURI)
        try {
            ajax = new XMLHttpRequest()
        } catch (t) {
            try {
                ajax = new ActiveXObject("Msxml2.XMLHTTP")
            } catch (t) {
                try {
                    ajax = new ActiveXObject("Microsoft.XMLHTTP")
                } catch (t) {
                    console.log("Something error....")
                }
            }
        }
        ////No Hearing//
        domStyle(`#add-event-modal .loader`, 'display:block;')
       listen('load',ajax,(e) => {
           let res = JSON.parse(e.target.responseText),
               y = res.results
               noticeOnEventResults(y)
                  ////No Hearing///
        $('.modal').modal('hide')
        on(`#add-event-modal [name="subject"]`).value = ''
        on(`#add-event-modal [name="location"]`).value = ''
        on(`#add-event-modal [name="startDate"]`).value = ''
        on(`#add-event-modal [name="startTime"]`).value = ''
        on(`#add-event-modal [name="endDate"]`).value = ''
        on(`#add-event-modal [name="endTime"]`).value = ''
        on(`#add-event-modal [name="textarea"]`).value = ''
        on(`#add-event-modal [name="files"]`).value = ''
        domStyle(`#add-event-modal .loader`, 'display:none;')  
                    
       })

        listen('abort', ajax, (e) => {
           noticeOnEventResults(false)
        })

        listen('error', ajax, (e) => {
          noticeOnEventResults(false)
        })

        ajax.open("POST", "./index.php?controller=home&action=createDateEvent")
        ajax.send(formdata)

     }

  });



listen('click',on(`tbody tr`,true), (e) => {
  let view = database[e.target.parentElement.dataset.src]
  domHTML(`#show-event .organizer`,`<b>Organizer</b> : ${view.name}`)
  domHTML(`#show-event .subject`,`<b>Subject</b> : ${view.subject}`)
  domHTML(`#show-event .location`,`<b>Location</b> : ${view.location}`)
  domHTML(`#show-event .startTime`,`<b>startTime</b> :${view.startTime}`)
  domHTML(`#show-event .endTime`,`<b> endTime</b> :${view.endTime}`)
  domHTML(`#show-event .summary`,`<b>Summary </b> : ${view.summary}`)
  domHTML(`#show-event .file`,`<b>Attachment</b> :${view.fileId != '0' ? `<a href="${ROOT_URL}uploads/attachment/${view.fileId}">Download</a>` : `No`}`)
})


});
