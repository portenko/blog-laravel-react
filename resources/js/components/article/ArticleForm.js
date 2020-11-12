import React, { Component } from 'react';
import axios from 'axios';
import CreatableSelect from 'react-select/creatable';
import { TitleSource } from '../teleporters/Title'
import Helmet from 'react-helmet';
import './ArticleForm.scss';

const components = {
  DropdownIndicator: null,
};

class ArticleForm extends Component
{
    constructor(props) {
      super(props);
      this.state = {
          error: null,
          isLoaded: false,
          name: '',
          body: '',
          tags: [],
          article: null,
          selectValues: [],
      };
    }

    handleChange = (event) => {
        const { error } = this.state;
        const errors = error && error.errors ? error.errors : false;
        if(errors){
            delete errors[event.target.name];
            this.setState({errors});
        }
        this.setState({[event.target.name]: event.target.value});
    }

    selectHandleChange = (value, actionMeta) => {
        this.setState({ selectValues: value, tags: value.map(tag => { return tag.value }) });
    };

    handleSubmit = (event) => {
        event.preventDefault();
        this.setState({
            isLoaded: true,
            errors: null
        });
        const { name, body, tags } = this.state;
        axios.post(process.env.MIX_API_URL+'/api/article', {name, body, tags})
        .then(res => {
            this.setState({
                error: null,
                isLoaded: true,
                article: res.data,
                name: '',
                body: '',
                tags: [],
                selectValues: [],
            });
        })
        .catch (error => {
            this.setState({
                isLoaded: true,
                error: error.response.data
            });
        });
    }

    render() {
        const { error, article, name, body, selectValues } = this.state;
        const errors = error && error.errors ? error.errors : false;
        const pageTitle = 'Add article';
        return (
            <>
                <Helmet>
                    <title>{pageTitle}</title>
                </Helmet>
                <TitleSource>{pageTitle}</TitleSource>
                {
                    article &&
                        <div className="alert alert-success">
                            The data was added successfully!
                        </div>
                }
                <div className="article-form">
                    <form onSubmit={this.handleSubmit}>
                        <div className="form-group">
                            <label>
                                <span>Title</span>
                                <input
                                    type="text"
                                    name="name"
                                    value={name}
                                    onChange={this.handleChange}
                                    className="form-control"
                                />
                                {(errors && errors.name) ? <div className="invalid">{errors.name}</div> : ''}
                            </label>
                        </div>
                        <div className="form-group">
                            <label>
                                <span>Content</span>
                                <textarea
                                    name="body"
                                    value={body}
                                    onChange={this.handleChange}
                                    className="form-control"
                                    rows="8"
                                />
                                {(errors && errors.body) ? <div className="invalid">{errors.body}</div> : ''}
                            </label>
                        </div>
                        <div className="form-group">
                            <label>
                                <span>Tags</span>
                                <CreatableSelect
                                    components={components}
                                    isClearable
                                    isMulti
                                    //menuIsOpen={false}
                                    onChange={this.selectHandleChange}
                                    name="tags"
                                    placeholder="Entry some tags here..."
                                    value={selectValues}
                                />
                                {(errors && errors.tags) ? <div className="invalid">{errors.tags}</div> : ''}
                            </label>
                        </div>
                        <input type="submit" value="Submit" className="btn"/>
                    </form>
                </div>
            </>
        )
    }
}

export default ArticleForm;
