const ele = {
        shift: `[name="shift"]`,
        ticket: `[name="ticket"]`,
        type: `[name="type"]`,
        jiraSummary: `[name="jiraSummary"]`,
        nocSummary: `[name="nocSummary"]`,
        priority: `[name="priority"]`,
        file: `[name="files"]`,
        alert: `.alert`,
        loader: `.loader`,
        displayDays: `[name="display_days"]`,
        eventResults: `#event-results`,
        csvListen : '#print_csv',
        csvCompile : '#csvCompile',
        csvCompileHtext : '#csvModal .h-text',
        csvCompileLoader : '#csvModal .spinner',
        csvCompiledLink : '.csv-link',
        csvFail : '#csvModal .alert-danger'
    },
    eventModal = (a) => {
        return `#add-event-modal ` + ele[a]
    }
addSingleRow = s => {
        if (!s) {
            return
        }
        let table = $(ele.eventResults).DataTable()
            //table.row.add([`Shift ${s.shift}`,`${s.event_time}`,`${s.ticket}`,`${s.type}`,`${s.jiraSummary}`,`${s.nocSummary}`,`S${s.priority}`,`${s.status == 1 ? 'Closed' : 'Pending'}`,`<a href='${s.fileId}'>Download</a>`]).draw( false )
        table.destroy()
        eventResults(parseInt(domValue(ele.displayDays)), 0)
    },
    noticeOnEventResults = (e) => {
        let message = e ? '<span uk-icon=\'icon: check\'></span> Event Succefully Added!' : '<span uk-icon=\'icon: warning\'></span> Fail to add event..!',
            status = e ? `success` : `danger`,
            position = 'top-center'
        UIkit.notification({
            message: message,
            status: status,
            pos: position
        })
    },
    eventResultsonSuccess = s => {
        let data = []
        s.forEach(e => {
                    data.push({
                                shift: e.shift == 1 ? `Day Shift` : `Night Shift`,
                                time: e.event_time,
                                ticket: e.ticket,
                                type: e.type,
                                jiraSummary: e.jiraSummary,
                                nocSummary: e.nocSummary,
                                priority: `${`S`+e.priority}`,
     status : `${e.status == 1 ? `Closed` : `Pending`}`,
     name : e.name,
    link : e.fileId && e.fileId != 0 ? `<a href=${ROOT_URL+`uploads/attachment/`+e.fileId}>Download</a>` : `No`})
})

let table = $(ele.eventResults).DataTable( {
        data: data,
        "columns": [
            { title : "Shiftbook","data": "shift" },
            {  title : "Event Time","data": "time" },
            {  title : "Key/Ticket","data": "ticket" },
            {  title : "Type","data": "type" },
            {  title : "Jira Summary","data": "jiraSummary" },
            {  title : "Noc Summary","data": "nocSummary" },
            {  title : "Priority","data": "priority" },
            {  title : "Status","data": "status" },
            {title : "Reporter", "data" : "name"},
            {  title : "Attachment","data": "link" }
        ],
        "order" : [[1, "desc"]],
        columnDefs: [
  { targets: 9, orderable: false }
]
    } )

    },
    eventResultsOnFail = e => {
console.log(e)
    },
    printEventResults = e => {
        e ? eventResultsonSuccess(e) : eventResultsOnFail(e)
    }
    ,
    eventResults = (days,sort) => {
        let ajax,
            ajaxData = new FormData()
            ajaxData.append('days',days)
            ajaxData.append('sort',sort)
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
listen('load',ajax, e => {
let x = e.target,
    readyState = x.readyState,
    text = readyState == 4 ? JSON.parse(x.responseText) : false,
    data = text ? text : false
    printEventResults(data)
})

listen('abort',ajax,e => {

})

listen('error',ajax,e => {

})
        ajax.open("POST", "./index.php?controller=home&action=eventResults")
        ajax.send(ajaxData)

    },
    csvCompile = (a,b,c) => {
let ajax,
    ajaxData = new FormData()
    ajaxData.append('row',a)
    ajaxData.append('order',b)
    ajaxData.append('days',c)
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


listen('load',ajax, e => {
let x = e.target,
    readyState = x.readyState,
    text = readyState == 4 ? JSON.parse(x.responseText) : false,
    data = text ? text : false
    domStyle(ele.csvCompileLoader,'display:none;')
    data ? (on(ele.csvCompiledLink).dataset.src = data,domStyle(ele.csvCompiledLink,'display:block;')) : domStyle(ele.csvFail,'display:block;')
})

listen('abort',ajax,e => {

})

listen('error',ajax,e => {

})

        ajax.open("POST", "./index.php?controller=home&action=csvCompile")
        ajax.send(ajaxData)

        ///End Function

    }

eventResults(15,0)


listen('change',on(ele.displayDays,true),e => {
    let table = $(ele.eventResults).DataTable()
    table.destroy()
    eventResults(parseInt(e.target.value),0)
})

listen('click', on('#submitevent'), () => {
    const shift = domValue(eventModal('shift')),
        ticket = domValue(eventModal(`ticket`)),
        type = domValue(eventModal(`type`)),
        jiraSummary = domValue(eventModal(`jiraSummary`)),
        nocSummary = domValue(eventModal(`nocSummary`)),
        priority = domValue(eventModal(`priority`)),
        file = on(eventModal(`file`)).files[0],
        error = !shift ? true : !ticket ? true : !type ? true : !jiraSummary ? true : !nocSummary ? true : !priority ? true : false
    if (error) {
        domStyle(eventModal(`alert`), 'display:;')
    } else {
        domStyle(eventModal(`alert`), 'display:none;')
        var formdata = new FormData(),
            ajax
        formdata.append('fileId', file ? Date.now()+file.name.replace(/[^a-zA-Z.]/g, "") : 0)
        formdata.append('shift', shift)
        formdata.append('ticket', ticket)
        formdata.append('type', type)
        formdata.append('jiraSummary', jiraSummary)
        formdata.append('nocSummary', nocSummary)
        formdata.append('priority', priority)
        formdata.append('file', file)

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
        domStyle(eventModal(`loader`), 'display:block;')


        listen('progress', ajax.upload, (e) => {

        })

        listen('load', ajax, (e) => {
            const x = e.target,
                readyState = x.readyState,
                text = readyState == 4 ? JSON.parse(x.responseText) : false
            addSingleRow(text)
            noticeOnEventResults(text)
                ////No Hearing//
            $('.modal').modal('hide')
            on(eventModal(`ticket`)).value = ``
            on(eventModal(`type`)).value = ``
            on(eventModal(`jiraSummary`)).value = ``
            on(eventModal(`nocSummary`)).value = ``
            on(eventModal(`file`)).value = ``
            domStyle(eventModal(`loader`), 'display:none;')


        })

        listen('abort', ajax, (e) => {
            noticeOnEventResults(false)
        })

        listen('error', ajax, (e) => {
           noticeOnEventResults(false)

        })

        ajax.open("POST", "./index.php?controller=home&action=createEvent")
        ajax.send(formdata)

    }
})


listen('click',on(ele.csvCompile),() => {
    let table = $(ele.eventResults).DataTable(),
        sort = table.order(),
        row = sort[0][0],
        order = sort[0][1],
        days = parseInt(domValue(ele.displayDays))
    domStyle(ele.csvCompile,'display:none;')
    domStyle(ele.csvCompileHtext,'display:none;')
    domStyle(ele.csvCompileLoader,'display:block;')
    csvCompile(row,order,days)
})

listen('click',on(ele.csvCompiledLink).children[1], (e) => {
  let downloadLink = ROOT_URL+e.target.parentNode.dataset.src
  window.open(downloadLink)
})