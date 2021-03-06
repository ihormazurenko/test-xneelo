const {useState, useEffect} = wp.element;
import {NewsItem} from '../news-item';
import {Drawer} from '../drawer';

const defaultURL = window.location.href;

export const News = () => {
    const [news, setNews] = useState(null);
    const [loading, setLoading] = useState(false);
    const [isOpen, setOpen] = useState(false);
    const [activePost, setPost] = useState(null);

    useEffect(() => {
        setLoading(true);
        fetch(siteUrl + '/wp-json/wp/v2/news?filter[orderby]=date&order=desc&_embed')
            .then(response => response.json())
            .then(posts => {
                setNews(posts);
                setLoading(false);
            });
    }, []);

    function onPostClick(id) {
        const post = news.find((item) => item.id === id);
        setOpen(true);
        setPost(news.find((item) => item.id === id));
        // update url with post
        if (history.pushState && post) {
            window.history.pushState({path: post.link}, '', post.link);
        }
        document.body.classList.add('overflow');
    }

    function onClose() {
        setPost(null);
        setOpen(false);
        // return url
        if (history.pushState) {
            window.history.pushState({path: defaultURL}, '', defaultURL);
        }
        document.body.classList.remove('overflow');
    }

    return (
        <>
            <ul className="archive-list">
                {loading && (
                    <li><p className='no-results'>Loading...</p></li>
                )}

                {news && news.map(data => {
                    return <NewsItem onClick={onPostClick} key={data.id} data={data} />
                })}

                {news && !loading && news.length === 0 && (
                    <li><p className='no-results'>Sorry, no news available.</p></li>
                )}
            </ul>

            <Drawer isOpen={isOpen} onClose={onClose}>
                {activePost && (
                    <article className="content content-style">
                        <h2 className="popup-title">{activePost.title.rendered}</h2>

                        {activePost.acf.length !== 0 && (

                            <ul className="custom-field-list">

                                {activePost.acf.city.length && (
                                    <li>City: <strong>{activePost.acf.city}</strong></li>
                                )}

                                {activePost.acf.custom_field.length && (
                                    <li>Another Custom Field: <strong>{activePost.acf.custom_field}</strong></li>
                                )}

                                {activePost.acf.gallery.length && (
                                    <li>Gallery:
                                        <ul className="custom-gallery">

                                            {activePost.acf.gallery.map(data => {
                                                const imgUrl = data.sizes.medium || data.url;

                                                return <li><div className="img-box"><img src={imgUrl} alt={data.alt} /></div></li>
                                            })}
                                        </ul>
                                    </li>
                                )}

                            </ul>

                        )}

                        <div dangerouslySetInnerHTML={{__html: activePost && activePost.content.rendered}} />
                    </article>
                )}
            </Drawer>

        </>
    );
};
