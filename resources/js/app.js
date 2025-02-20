import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('content');

    if (textarea) {
        textarea.addEventListener('input', () => {
            textarea.style.height = 'auto'; // 重置高度
            textarea.style.height = `${textarea.scrollHeight}px`; // 根据内容自动调整高度
        });
    }
});
