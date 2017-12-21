import { Component, ViewChild, OnInit  } from '@angular/core';
import { TreeComponent, TreeModel, TreeNode, TREE_ACTIONS, KEYS, IActionMapping, ITreeOptions } from 'angular-tree-component';

@Component({
    templateUrl: 'tree.component.html'
})
export class TreeDragDropComponent {
    @ViewChild('tree') treeComponent: TreeComponent;

    nodes = [
        {
            id: 1,
            name: 'root1',
            children: [
                { id: 2, name: 'child1' },
                { id: 3, name: 'child2' }
            ]
        },
        {
            id: 4,
            name: 'root2',
            children: [
                { id: 5, name: 'child2.1' },
                { id: 6, name: 'child2.2' }
            ]
        }
    ];

    actionMapping: IActionMapping = {
        mouse: {
            dragEnd: TREE_ACTIONS.EXPAND,
        }
    }

    options: ITreeOptions = {
        actionMapping: this.actionMapping, // not working
        isExpandedField: 'children',
        allowDrag: (node) => {
            return true;
        },
        allowDrop: (node, to) => {
            if (node.hasChildren) {
                if (to.parent.parent == null) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if (to.parent.hasChildren) {
                    return true;
                } else if (to.parent.parent == null) {
                    return true;
                } else if (to.parent.isRoot != null && to.parent.isRoot) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        nodeClass: (node) => {
            return '';
        }
    }

    expandTreeNodes() { // not working // will try later
        const treeModel: TreeModel = this.treeComponent.treeModel;
        treeModel.expandAll();
    }
}
