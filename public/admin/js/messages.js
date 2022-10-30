async function selectMessage(mail){
    let element = document.getElementById(mail);
    let nodes = document.querySelectorAll('.chat_list');
    nodes.forEach(nodo => {
        nodo.classList.remove('active_chat');
    });
    element.classList.add('active_chat');
    let response = await fetch(`messages/${mail}`);
    if(response.ok){
        let json = await response.json();
        let msg_history = document.getElementById('msg_history');
        msg_history.innerHTML = "";
        json.forEach(msg => {
            let date = new Date(msg.created_at);
            msg_history.innerHTML += `
            <div class="outgoing_msg">
                <div class="sent_msg">
                <p>${msg.message}</p>
                <span class="time_date"> 
                ${
                    new Intl.DateTimeFormat("es-ES",{
                        dateStyle: "medium",
                        timeStyle: "medium",
                        timeZone: "America/Bogota",
                        hour12: true
                    }).format(date)
                }
                </span> 
                </div>
            </div> 
            `
        });
    }else{
        console.error(`Error HTTP ${response.status}`)
    }
}   
let get = window.location.search.substring(1);
get = get.split('=');
if(typeof get[1] != 'undefined'){
    selectMessage(get[1]);
}
