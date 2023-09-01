
const app_url = location.origin;

let sendRequest = ()=>{
    try {
        let btn = document.querySelector('.js__btn__import');
        btn.addEventListener('click', async (e)=>{

            let url = app_url+'/import';
            await load()
            const csrfToken = document.querySelector('[name=csrf-token]').content;
            const headers = new Headers({
                'X-CSRF-TOKEN':csrfToken,
                'Cache-Control': 'no-cache, no-store'
            })
            const response = await fetch(url,{
                method:'POST',
                headers,
            })
                .then(res=>res.json());

            if(response.status){
                document.querySelector('.js__all_users').innerText = response.all_users;
                document.querySelector('.js__created_users').innerText = response.created_users;
                document.querySelector('.js__updated_users').innerText = response.updated_users;
                await load()
            }
        })
    }catch(error){
        console.log('Error:', error);
    }
}

let load = ()=>{
    let load = document.querySelector('.js__loader');
    load.classList.toggle('loader__show');
}

document.addEventListener('DOMContentLoaded', ()=>{
    sendRequest();
})
