const API = 'https://boardy-api.emrysdev.xyz';
const POST_ID = 1;

// Эта функция обязательна при использовании innerHTML!
function esc(str) {
    if (!str) return ''; // защита от null/undefined
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

async function loadComments() {
    try {
        const res = await fetch(`${API}/api/posts/${POST_ID}/comments`);
        
        if (!res.ok) throw new Error(`Ошибка HTTP: ${res.status}`);
        
        const data = await res.json();
        
        const listDiv = document.getElementById('list');
        
        if (data.items.length === 0) {
            listDiv.innerHTML = '<p>Пока нет комментариев. Будьте первым!</p>';
            return;
        }

        // map() создает массив HTML-строк, join('') склеивает их
        listDiv.innerHTML = data.items.map(item => `
            <div class="comment">
                <div>
                    <span class="comment-author">${esc(item.author_name)}</span>
                    <span class="comment-date">${esc(item.created_at)}</span>
                </div>
                <div class="comment-body">${esc(item.body)}</div>
            </div>
        `).join('');

    } catch (error) {
        console.error('Ошибка загрузки:', error);
        document.getElementById('list').innerHTML = '<p style="color:red">Не удалось загрузить комментарии.</p>';
    }
}

document.getElementById('btn').addEventListener('click', async () => {
    const bodyInput = document.getElementById('body');
    const bodyText = bodyInput.value.trim();
    
    // Валидация: не отправляем пустой запрос
    if (!bodyText) {
        alert('Введите текст комментария');
        return; 
    }

    // Блокируем кнопку на время отправки
    const btn = document.getElementById('btn');
    btn.disabled = true;
    btn.textContent = 'Отправка...';

    try {
        const res = await fetch(`${API}/api/posts/${POST_ID}/comments`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ body: bodyText })
        });

        if (res.ok) {
            // Успех: очистить поле, разблокировать кнопку, обновить список
            bodyInput.value = '';
            await loadComments();
        } else {
            // Если сервер вернул 422 или другую ошибку
            const errorData = await res.json();
            console.error('Ошибка сервера:', errorData);
            alert('Ошибка при отправке комментария');
        }
    } catch (error) {
        console.error('Сетевая ошибка:', error);
        alert('Сетевая ошибка. Проверьте консоль.');
    } finally {
        // Всегда возвращаем кнопку в исходное состояние
        btn.disabled = false;
        btn.textContent = 'Отправить';
    }
});

// Запускаем первоначальную загрузку при открытии страницы
loadComments();
