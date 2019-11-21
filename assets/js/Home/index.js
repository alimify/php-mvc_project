var cleartimes,
  nowTime = new Date().getTime();

const e = {
    shift1: ".shift1",
    shift1header: `.shift1 header`,
    shift1table: "#shift1",
    shift2table: `#shift2`,
    shift2header: `.shift2 header`,
    shift2: `.shift2`,
    closeShiftList: "#eventCloseList",
    closeModalCall: "#closeModalcall",
    submitShift: "#submitshift",
    shiftCloseModalChecked: ".eventListchecked",
    shiftCloseModalH: "#shiftCloseModal h4",
    headerDate: "#showing-date",
    datePlus: "#date-plus",
    dateMinus: "#date-minus",
    monthlyCalender: "#month-calender"
  },
  d = {},
  f = {
    morningShift: a => {
      let json = JSON.parse(a.target.responseText),
        date = json.date,
        query = json.query,
        shift1header = `<img src="${ROOT_URL}assets/images/day.png"> ${date}`;
      domHTML(e.shift1header, shift1header);
      domHTML(e.headerDate, date);
      f.printTable(query, e.shift1table);
    },
    eveningShift: a => {
      let json = JSON.parse(a.target.responseText),
        date = json.date,
        query = json.query,
        shift2header = `<img src="${ROOT_URL}assets/images/night.png"> ${date}`;
      domHTML(e.shift2header, shift2header);
      f.printTable(query, e.shift2table);
    },
    closeShiftList: a => {
      //console.log(a.target.responseText)
      let json = JSON.parse(a.target.responseText),
        date = json.date,
        query = json.query,
        c = session(e.closeShiftList);
      c
        ? $(e.closeShiftList)
            .DataTable()
            .destroy()
        : session(e.closeShiftList, true);
      domHTML(e.shiftCloseModalH, "Events of " + date);
      f.printTable(query, e.closeShiftList, true);
    },
    closeShift: a => {
      //console.log(a.target.responseText);
      let json = JSON.parse(a.target.responseText),
        True = json.true,
        False = json.false,
        message = True
          ? `<span uk-icon=\'icon: check\'></span> ${True} event(s) successfully closed..<br/>${
              False ? False + " event(s) fail to close.." : ""
            }`
          : False
            ? `<span uk-icon=\'icon: warning\'></span> ${False} event(s) Fail to close..!`
            : `Shift closed,No event selected..`,
        status = True ? `success` : False ? `danger` : "",
        position = "top-center",
        shift1table = $(e.shift1table).DataTable(),
        shift2table = $(e.shift2table).DataTable();
      $(".modal").modal("hide");
      UIkit.notification({
        message: message,
        status: status,
        pos: position
      });

      shift1table.destroy();
      shift2table.destroy();
      f.ajax(
        "./index.php?controller=home&action=morningShift",
        f.morningShift,
        f.morningShiftError,
        f.morningShiftError
      );
      f.ajax(
        "./index.php?controller=home&action=eveningShift",
        f.eveningShift,
        f.eveningShiftError,
        f.eveningShiftError
      );
    },
    monthlyCalender: a => {
      //console.log(a.target.responseText)
      let json = JSON.parse(a.target.responseText),
        head = "",
        foot = "",
        bodyDay = "",
        bodyName = ``,
        body = ``;

      json.forEach(e => {
        head += `<th>${e.shift1}</th>`;
        foot += `<th>${e.shift2}</th>`;
        bodyDay += `<td><button value="${e.day}">${e.day}</button></td>`;
        bodyName += `<td>${e.name}</td>`;
      });
      head = `<tr><th>Day Shift</th>${head}</tr>`;
      foot = `<tr><th>Night Shift</th>${foot}</tr>`;
      body = `<tr><td></td>${bodyDay}</tr><tr><td></td>${bodyName}</tr>`;
      domHTML(e.monthlyCalender + " thead", head);
      domHTML(e.monthlyCalender + " tfoot", foot);
      domHTML(e.monthlyCalender + " tbody", body);
    },
    morningShiftError: a => {},
    eveningShiftError: a => {},
    closeModalListError: a => {},
    closeShiftError: a => {},
    monthlyCalenderError: a => {},
    printTable: (a, b, c = false) => {
      let data = [];
      a.forEach(e => {
        data.push({
          shift: e.shift == 1 ? `Day Shift` : `Night Shift`,
          time: e.event_time,
          ticket: e.ticket,
          type: e.type,
          jiraSummary: e.jiraSummary,
          nocSummary: e.nocSummary,
          priority: `${`S` + e.priority}`,
          status: `${e.status == 1 ? `Closed` : `Pending`}`,
          name: e.name,
          link:
            e.fileId && e.fileId != 0
              ? `<a href=${ROOT_URL +
                  `uploads/attachment/` +
                  e.fileId}>Download</a>`
              : `No`,
          checkbox: `<input type="checkbox" name="eventList" class="eventListchecked" value="${
            e.id
          }">`
        });
      });

      $(b).DataTable({
        data: data,
        columns: [
          { title: "Select", data: "checkbox" },
          { title: "Shiftbook", data: "shift" },
          { title: "Event Time", data: "time" },
          { title: "Key/Ticket", data: "ticket" },
          { title: "Type", data: "type" },
          { title: "Jira Summary", data: "jiraSummary" },
          { title: "Noc Summary", data: "nocSummary" },
          { title: "Priority", data: "priority" },
          { title: "Status", data: "status" },
          { title: "Reporter", data: "name" },
          { title: "Attachment", data: "link" }
        ],
        order: [[2, "desc"]],
        columnDefs: [
          { targets: 10, orderable: false, searchable: false },
          { targets: 0, orderable: false, searchable: false, visible: c }
        ],
        searching: c,
        paging: false,
        bInfo: false
      });
    },
    ajax: (a, b = f.ajaxLoad, c = f.ajaxError, d = f.ajaxAbort, e = false) => {
      let ajax,
        formdata = new FormData();
      formdata.append("data", e);
      try {
        ajax = new XMLHttpRequest();
      } catch (t) {
        try {
          ajax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (t) {
          try {
            ajax = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (t) {
            console.log("Something error....");
          }
        }
      }

      listen("load", ajax, b);
      listen("error", ajax, c);
      listen("abort", ajax, d);
      ajax.open("POST", a);
      ajax.send(formdata);
      ///End Ajax
    },
    ajaxLoad: a => {},
    ajaxError: a => {},
    ajaxAbort: a => {},
    callPrint: (a, b = false, c = false) => {
      clearTimeout(cleartimes);
      cleartimes = setTimeout(() => {
        if (c) {
          $(e.shift1table)
            .DataTable()
            .destroy();
          $(e.shift2table)
            .DataTable()
            .destroy();
        }
        f.ajax(
          `./index.php?controller=home&action=morningShift&time=${a}`,
          f.morningShift,
          f.morningShiftError,
          f.morningShiftError,
          b
        );
        f.ajax(
          `./index.php?controller=home&action=eveningShift&time=${a}`,
          f.eveningShift,
          f.eveningShiftError,
          f.eveningShiftError,
          b
        );
        f.ajax(
          `./index.php?controller=home&action=getDaywName&time=${a}`,
          f.monthlyCalender,
          f.monthlyCalenderError,
          f.monthlyCalenderError,
          b
        );
      }, 1000);
    }
  };

session(e.closeShiftList, false, true);
f.callPrint(nowTime);

listen("click", on(e.datePlus), () => {
  nowTime += 86400000;
  f.callPrint(nowTime, false, true);
});

listen("click", on(e.dateMinus), () => {
  nowTime -= 86400000;
  f.callPrint(nowTime, false, true);
});

listen("click", on(e.closeModalCall), () => {
  f.ajax(
    `./index.php?controller=home&action=eventCloseList&time=${nowTime}`,
    f.closeShiftList,
    f.closeModalListError,
    f.closeModalListError
  );
});
listen("click", on(e.submitShift), () => {
  let x = on(e.shiftCloseModalChecked, true),
      y = []
    
  x.forEach(e => {
    e.checked ? y.push(e.value) : false;
  });

  var res = {id: y, message: domValue('#shiftCloseModal textarea')},
      rest = JSON.stringify(res)
  f.ajax(
    `./index.php?controller=home&action=closeShift&time=${nowTime}`,
    f.closeShift,
    f.closeShiftError,
    f.closeShiftError,rest
  );
  on('#shiftCloseModal textarea').value = ''
});

$("body").on("click", "tbody td button", e => {
  let date = new Date(nowTime),
    y = date.getFullYear(),
    m = date.getMonth() + 1,
    d = e.target.value,
    fo = `${y}-${m}-${d}`;
  nowTime = new Date(fo).getTime();
  f.callPrint(nowTime, false, true);
});
