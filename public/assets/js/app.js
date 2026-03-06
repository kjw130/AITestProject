// Thin fetch wrapper — returns parsed JSON
async function api(route, options = {}) {
    const url = '/api.php?route=' + route;
    const res = await fetch(url, {
        headers: { 'Content-Type': 'application/json' },
        ...options,
    });
    if (!res.ok) throw new Error(`API error ${res.status}`);
    return res.json();
}

// Entry point
async function init() {
    const users = await api('users');
    document.getElementById('content').innerHTML =
        users.length
            ? users.map(u => `<p>${u.name}</p>`).join('')
            : '<p>No data yet.</p>';
}

document.addEventListener('DOMContentLoaded', init);
