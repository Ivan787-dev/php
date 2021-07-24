document.querySelector('button').addEventListener("click", () => {
    const searchedUsers = document.querySelectorAll('.searched-users')
    searchedUsers.forEach(item => {
        item.remove()
    })
    document.querySelector('button').remove()
})