var log = console.log;

const send_post = (id_post) => {

    edit_url = `http://www.abogadoericprice.com/post.php?${id_post}`;

    window.location.href = edit_url;

}