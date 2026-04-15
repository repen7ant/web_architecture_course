const { useState, useEffect } = React;

const API = 'https://boardy-api.emrysdev.xyz';
const POST_ID = 1;

function CommentApp() {
    const [items, setItems] = useState([]);
    const [text, setText] = useState('');
    const [editId, setEditId] = useState(null);
    const [editText, setEditText] = useState('');

    const load = async () => {
        try {
            const res = await fetch(`${API}/api/posts/${POST_ID}/comments`);
            const data = await res.json();
            setItems(data.items);
        } catch (e) {
            console.error("Ошибка загрузки", e);
        }
    };

    useEffect(() => { load(); }, []);

    const add = async () => {
        if (!text.trim()) return;
        await fetch(`${API}/api/posts/${POST_ID}/comments`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ body: text })
        });
        setText('');
        load();
    };

    const save = async (id) => {
        await fetch(`${API}/api/comments/${id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ body: editText })
        });
        setEditId(null);
        load();
    };

    const del = async (id) => {
        if (!confirm('Удалить этот комментарий?')) return;
        await fetch(`${API}/api/comments/${id}`, { method: 'DELETE' });
        load();
    };

    return (
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Комментарии</h3>
            </div>
            <div class="card-body">
                {items.map(item => (
                    <div key={item.id} className="card mb-3 comment-card">
                        <div className="card-body">
                            <div className="d-flex justify-content-between border-bottom pb-2 mb-2">
                                <strong className="text-primary">{item.author_name}</strong>
                                <small className="text-muted">{item.created_at}</small>
                            </div>

                            {editId === item.id ? (
                                <div className="input-group">
                                    <input 
                                        className="form-control" 
                                        value={editText} 
                                        onChange={e => setEditText(e.target.value)} 
                                    />
                                    <button className="btn btn-success" onClick={() => save(item.id)}>✅</button>
                                    <button className="btn btn-secondary" onClick={() => setEditId(null)}>❌</button>
                                </div>
                            ) : (
                                <div>
                                    <p className="card-text">{item.body}</p>
                                    <div className="d-flex gap-2">
                                        <button 
                                            className="btn btn-sm btn-outline-secondary" 
                                            onClick={() => { setEditId(item.id); setEditText(item.body); }}
                                        >Редактировать</button>
                                        <button 
                                            className="btn btn-sm btn-outline-danger" 
                                            onClick={() => del(item.id)}
                                        >Удалить</button>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                ))}

                <div className="mt-4 pt-3 border-top">
                    <h5>Оставить комментарий</h5>
                    <div className="input-group">
                        <input 
                            className="form-control" 
                            placeholder="Напишите что-нибудь..." 
                            value={text} 
                            onChange={e => setText(e.target.value)} 
                        />
                        <button className="btn btn-primary" onClick={add}>Отправить</button>
                    </div>
                </div>
            </div>
        </div>
    );
}

const root = ReactDOM.createRoot(document.getElementById('app'));
root.render(<CommentApp />);
