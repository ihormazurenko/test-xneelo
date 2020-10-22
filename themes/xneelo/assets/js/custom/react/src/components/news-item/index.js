import {strip_tags} from '../../utils';

function prepareImg (dataImg) {
    if(dataImg) {
        const details = dataImg.media_details;
        const img = details.sizes.medium_large || details.sizes.full;

        return (
            <img src={img.source_url} alt={dataImg.alt_text} />
        );
    }

    return null;
}

export const NewsItem = ({data, onClick}) => {
    const img = prepareImg(data._embedded['wp:featuredmedia'][0]);

    function onPostClick(e) {
        e.preventDefault();
        onClick(data.id)
    }

    return (
        <li>
            {img ? (
                <div className="image-box">
                    <a href={data.link} title={data.title.rendered} onClick={onPostClick}>
                        {img}
                    </a>
                </div>
            ) : null}

            <div className="content-box">
                <header>
                    <h2><a href={data.link} onClick={onPostClick} title={data.title.rendered}>{data.title.rendered}</a></h2>
                </header>

                {data._embedded['wp:term'].length !== 0 && (
                    <span className="categories">
                        {data._embedded['wp:term'][0].map(data => {
                            return <a href={data.link} title={data.name}>{data.name}</a>
                        })}
                    </span>
                )}

                <div className="excerpt">
                    {strip_tags(data.content.rendered)}
                    &hellip;&nbsp;
                    <a href={data.link} onClick={onPostClick} title={data.title.rendered + " - more"}>more</a>
                </div>
            </div>
        </li>
    );
}