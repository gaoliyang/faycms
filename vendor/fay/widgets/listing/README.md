#列表
存储一个一维的列表，并通过设定的模板进行渲染。适用于多行纯文本输出的场景。

**模版**

此工具模版为单行模版，例如：模版为
```php
<p>{$value}</p>
```
则渲染结果类似
```html
<p>第一行文本内容</p>
<p>第二行文本内容</p>
<p>第三行文本内容</p>
```