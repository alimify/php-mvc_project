const on = (a, b = false) => {
        return b ? document.querySelectorAll(a) : document.querySelector(a)
    },
    listen = (a, b, c , d = true) => {
      b.length && d ? b.forEach(e => { e.addEventListener(a, c) }) : b.addEventListener(a, c)
        return
    },
    domStyle = (a,b = false) =>{
    	let c = on(a).style
      return b ? (c.cssText = b,c) : c
    },
    domValue = (a,b = false) => {
    	let c = on(a)
    	return b ? (c.value = b,c.value) : c.value 
    },
    domHTML = (a,b = false) => {
    	let c = on(a)
    	return b ? (c.innerHTML = b,c.innerHTML) : c.innerHTML
    },
    session = (a,b = false,c = false) => {
    return a && !b && !c ? JSON.parse(sessionStorage.getItem(a))  : a && b && !c ? (sessionStorage.setItem(a, JSON.stringify(b)),true) : a && c && !b ?  (sessionStorage.removeItem(a),true) : false
    }
