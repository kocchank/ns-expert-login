const form = document.getElementById("form")
const submitButton = document.getElementById("submit")

submitButton.onclick = () => {
  const formData = new FormData(form)
  const action = form.getAttribute("action")
  const options = {
    method: 'POST',
    body: formData,
  }
  fetch(action, options).then((e) => {
	  if(e.status === 200) {
      window.location.reload();
      return
    }
    if(e.status === 202) {
      alert("IDまたはパスワードが間違っています。")
      return
    }
    alert("不明なエラーが発生しました。")
  })
}